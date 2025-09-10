#include <SPI.h>
#include <MFRC522.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <ESP32Servo.h>

#define SS_PIN  21   
#define RST_PIN 22   
#define SERVO_PIN  15  
#define BUTTON_PIN 4 

MFRC522 mfrc522(SS_PIN, RST_PIN);
Servo myServo;

const char* ssid     = "FAMILIAAGUA";
const char* password = "muraca20";
const char* serverName = "http://192.168.1.159/php/verificandoUID.php";

bool isInside = false;
bool buttonState = false;
bool lastButtonState = false;

void setup() {
  Serial.begin(115200);
  delay(10000);
  SPI.begin();       
  mfrc522.PCD_Init(); 
  WiFi.begin(ssid, password);

  myServo.attach(SERVO_PIN);  
  myServo.write(0);  // Inicia com a porta "fechada"

  pinMode(BUTTON_PIN, INPUT_PULLUP);  // Configura o botão com resistor pull-up interno

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Conectando ao Wi-Fi...");
  }

  Serial.println("Wi-Fi conectado");
}

void loop() {
  // Verifica o estado do push button
  buttonState = digitalRead(BUTTON_PIN);

  // Detecta mudança de estado do botão (pressão do botão)
  if (buttonState == LOW && lastButtonState == HIGH) {
    abrirPorta();  // Abre a porta quando o botão é pressionado
  }
  lastButtonState = buttonState;

  if (!mfrc522.PICC_IsNewCardPresent()) {
    return;
  }

  if (!mfrc522.PICC_ReadCardSerial()) {
    return;
  }

  // Obtem o UID do cartão RFID
  String uidString = "";
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    uidString += String(mfrc522.uid.uidByte[i], HEX);
  }

  Serial.print("UID do cartão: ");
  Serial.println(uidString);

  // Envia o UID para o servidor
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    String url;

    if (!isInside) {
      url = String(serverName) + "?uid=" + uidString + "&tipo_evento=entrada";
    } else {
      url = String(serverName) + "?uid=" + uidString + "&tipo_evento=saida";
    }

    http.begin(url);
    int httpResponseCode = http.GET();

    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println("Resposta do servidor: " + response);
      
      if (response.indexOf("UID encontrado") >= 0) {
        abrirPorta();  
        isInside = !isInside; 
      } else {
        Serial.println("UID não encontrado, porta permanecerá fechada");
      }
    } else {
      Serial.println("Erro ao enviar UID: " + String(httpResponseCode));
    }

    http.end();
  }
  delay(1000);
}

void abrirPorta() {
  myServo.write(90);  
  Serial.println("Porta aberta");

  delay(5000);
  
  myServo.write(0);
  Serial.println("Porta fechada");
}

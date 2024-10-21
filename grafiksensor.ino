//Library DHT11
#include "DHT.h"
//Library Wifi
#include <WiFi.h>
#include "HTTPClient.h"

//define pin DHT11
#define DHTPIN 4 //pin GPIO4
#define DHTTYPE DHT11

// Variabel Wifi Hotspot & Password
const char* ssid = "Livi";
const char* pass = "12tigaempat";

// Variabel Host/Server Web
const char* host = "192.168.1.5";

// Port Web Server = 8080
const int httpPort = 8080;

//Object DHT11
DHT sensor_dht (DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(9600);
  sensor_dht.begin();

  // Setup Wifi
  WiFi.begin(ssid, pass); 
  Serial.println("Connecting...");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print("...");
    delay(500);
  }
  // If Success Connected
  Serial.println("Connected");
}


void loop() {
  // Read Nilai Suhu dan Kelembaban
  float suhu = sensor_dht.readTemperature();
  float kelembaban = sensor_dht.readHumidity();

  // Cek apakah pembacaan suhu atau kelembaban berhasil
  if (isnan(suhu) || isnan(kelembaban)) {
    Serial.println("Failed to read from DHT sensor!");
    return;  // Jika gagal, keluar dari loop saat ini
  }

  // Tampilkan ke serial monitor
  Serial.println("Suhu: " + String(suhu) + " C");
  Serial.println("Kelembaban: " + String(kelembaban) + " %");
  Serial.println();

  // Data -> Server
  HTTPClient http; 
  String link = "http://" + String(host) + ":" + String(httpPort) + "/grafiksensor/kirimdata.php?suhu=" + String(suhu) + "&kelembaban=" + String(kelembaban);

  // Eksekusi Alamat Link
  http.begin(link); 

  // Mendapatkan HTTP response code
  int httpResponseCode = http.GET(); 
  Serial.print("HTTP Response Code: ");
  Serial.println(httpResponseCode);

  // Respon Setelah Sukses Nilai kirim sensor
  if (httpResponseCode > 0) {
    String respon = http.getString(); // Ambil respon dari server
    Serial.println("Response from server: " + respon);
  } else {
    Serial.print("Error on sending GET: ");
    Serial.println(httpResponseCode); // Jika gagal, cetak error
  }

  http.end(); // Mengakhiri koneksi HTTP

  delay(1000);
}

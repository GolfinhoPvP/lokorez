#define VOLTAGEINPUTVALUE 5.0
#define LIGTHLIMIT 1000.0
#define LIGTHMODE '0'
#define TEMPERATUREMODE '1'
#define LIGTHANDTEMPERATUREMODE '2'

int lightSensorPin = 0, temperatureSensorPin = 1, ligth;
float temperature;
char serialInput;

void setup(){
   Serial.begin(9600);
}

void loop(){
  if( Serial.available() ){
    serialInput = Serial.read();
    switch(serialInput){
      case LIGTHMODE:
        ligth = getLigth();
        Serial.print("Ligth value: ");
        Serial.println(ligth);
        break;
      case TEMPERATUREMODE:
        temperature = getTemperature();
        Serial.print("Temperature value: ");
        Serial.println(temperature);
        break;
      case LIGTHANDTEMPERATUREMODE:
        ligth = getLigth();
        temperature = getTemperature();
        Serial.print("Ligth value: ");
        Serial.print(ligth);
        Serial.print(", Temperature value: ");
        Serial.println(temperature);
        break;
      default: Serial.println("Invalid input!");
    }
  }  
}

float getTension(float input){
  return ((input * VOLTAGEINPUTVALUE) / 1023.0);
}

float getTemperature(){
  float temperatureRead = analogRead(temperatureSensorPin);
  float ten = getTension(temperatureRead);
  return ten * 100;
}

int getLigth(){
  int ligthRead = analogRead(lightSensorPin);
  return ligthRead;
}


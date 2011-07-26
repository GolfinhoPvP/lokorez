#include <Fuzzy.h>

#define ANALOG_VARIATION 1024
#define VOLTAGE_USAGE 5.0
#define VARIATION -1.4
#define THERETICAL_DISTANCE 65

int IRPin = 0;
float valuePerStep = 0.0;

Fuzzy fuzzy(1);

FuzzySet perto(0, 0, 25, 50);
FuzzySet medio(25, 50, 50, 75);
FuzzySet longe(50, 75, 100, 100);

void setup() {
  Serial.begin(9600);
  valuePerStep = VOLTAGE_USAGE / ANALOG_VARIATION;
  
  fuzzy.setFuzzySetsInput(0, 0, &perto);
  fuzzy.setFuzzySetsInput(0, 1, &medio);
  fuzzy.setFuzzySetsInput(0, 2, &longe);
}

void loop() {
  float volts = analogRead(IRPin)*valuePerStep;

  float distance = THERETICAL_DISTANCE * pow(volts, VARIATION);
  
  fuzzy.setInputs(0, distance);
   
  fuzzy.fuzzify(0);
  
  Serial.println(distance);
  Serial.println(fuzzy.getFuzzification(0,0)); 
  Serial.println(fuzzy.getFuzzification(0,1));
  Serial.println(fuzzy.getFuzzification(0,2));
  Serial.println("-");

  delay(1000);
}

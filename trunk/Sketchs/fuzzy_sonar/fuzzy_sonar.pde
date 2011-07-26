#include <Fuzzy.h>

// variables to take x number of readings and then average them
// to remove the jitter/noise from the DYP-ME007 sonar readings
const int numOfReadings = 10;
// number of readings to take/ items in the array
int readings[numOfReadings];
// stores the distance readings in an array
int arrayIndex = 0;
// arrayIndex of the current item in the array
int total = 0;
// stores the cumlative total
int averageDistance = 0;
// DYP-ME007 echo pin (digital 5)
int echoPin = 5;
// DYP-ME007 trigger pin (digital 4)
int initPin = 4;
// stores the pulse in Micro Seconds
unsigned long pulseTime = 0;
// variable for storing the distance (cm)
unsigned long distance = 0;

Fuzzy fuzzy(1);

FuzzySet perto(0, 0, 25, 50);
FuzzySet medio(25, 50, 50, 75);
FuzzySet longe(50, 75, 100, 100);

//setup
void setup() {
  // initialize the serial port, lets you view the distances being pinged if connected to computer
  Serial.begin(9600);
  // set init pin as output
  pinMode(initPin, OUTPUT);
  // set echo pin as input
  pinMode(echoPin, INPUT);
  // create array loop to iterate over every item in the array
  for (int thisReading = 0; thisReading < numOfReadings; thisReading++) {
    readings[thisReading] = 0;
  }
  
  fuzzy.setFuzzySetsInput(0, 0, &perto);   //Set 1
  fuzzy.setFuzzySetsInput(0, 1, &medio);   //Set 2
  fuzzy.setFuzzySetsInput(0, 2, &longe);   //Set 3
}

// execute
void loop() {
  // send 10 microsecond pulse
  digitalWrite(initPin, HIGH);
  // wait 10 microseconds before turning off
  delayMicroseconds(10);
  // stop sending the pulse
  digitalWrite(initPin, LOW);
  
  // Look for a return pulse, it should be high as the pulse goes low-high-low
  pulseTime = pulseIn(echoPin, HIGH);
  // Distance = pulse time / 58 to convert to cm.
  distance = pulseTime/58;
  
  // subtract the last distance
  total = total - readings[arrayIndex];
  // add distance reading to array
  readings[arrayIndex] = distance;
  // add the reading to the total
  total = total + readings[arrayIndex];
  
  arrayIndex = arrayIndex + 1;
  // go to the next item in the array
  // At the end of the array (10 items) then start again
  if (arrayIndex >= numOfReadings) {
    arrayIndex = 0;
    // calculate the average distance
    averageDistance = total / numOfReadings;
    
    fuzzy.setInputs(0, averageDistance);
   
    fuzzy.fuzzify(0);
   
    Serial.println(averageDistance);
    Serial.println(fuzzy.getFuzzification(0,0)); 
    Serial.println(fuzzy.getFuzzification(0,1));
    Serial.println(fuzzy.getFuzzification(0,2));
    Serial.println("-");
    
    delay(1000);
  }
}

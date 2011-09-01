/*
  AJ Alves.
  aj.alves@live.com
*/

/********************************************************************
 * IMPLEMENTATION
 ********************************************************************/

#include <Fuzzy.h>
#include <Servo.h>
#include <Continuous2Wheels.h>

#define ANALOG_VARIATION 1024
#define VOLTAGE_USAGE 5.0
#define VARIATION -1.4
#define THERETICAL_DISTANCE 65

int contador = 0;

int rightWheelPin = 9;
int leftWheelPin = 10;
double wheelRadius = 3.6;
double bendRadius = 12.2;
double resistance = 2.6;

//Continuous2Wheels c2w(rightWheelPin, leftWheelPin, wheelRadius, bendRadius, resistance);

int IRRigthPin = 0; // analog pin for reading the IR sensor
int IRLeftPin = 1; // analog pin for reading the IR sensor
float valuePerStep = 0.0; // value from sensor * (5/1024) - if running 3.3.volts then change 5 to 3.3

Fuzzy fuzzy(2);

FuzzySet pertoDireita(0, 0, 12.5, 25);
FuzzySet medioDireita(12.5, 25, 25, 37.5);
FuzzySet longeDireita(25, 37.5, 50, 50);

FuzzySet pertoEsquerda(0, 0, 12.5, 25);
FuzzySet medioEsquerda(12.5, 25, 25, 37.5);
FuzzySet longeEsquerda(25, 37.5, 50, 50);

FuzzySet girarEsquerda(-180,-90,-90,-1);
FuzzySet girarPouco(-20,0,0,20);                                            
FuzzySet girarDireita(1, 90, 90, 180);

FuzzyRule rule1(&pertoDireita,&pertoEsquerda,&girarPouco);
FuzzyRule rule2(&pertoDireita,&medioEsquerda,&girarEsquerda);
FuzzyRule rule3(&pertoDireita,&longeEsquerda,&girarEsquerda);

FuzzyRule rule4(&medioDireita,&pertoEsquerda,&girarDireita);
FuzzyRule rule5(&medioDireita,&medioEsquerda,&girarPouco);
FuzzyRule rule6(&medioDireita,&longeEsquerda,&girarEsquerda);

FuzzyRule rule7(&longeDireita,&pertoEsquerda,&girarDireita);
FuzzyRule rule8(&longeDireita,&medioEsquerda,&girarDireita);
FuzzyRule rule9(&longeDireita,&longeEsquerda,&girarPouco);

void setup(){  
  Serial.begin(9600);
  
  //c2w.setDebugMode(true);
  //c2w.setBendSmooth(0.2);
  
  valuePerStep = VOLTAGE_USAGE / ANALOG_VARIATION;
  
  //Entrada 0 - Sensor Direita
  fuzzy.addFuzzySet(0,0, &pertoDireita);
  fuzzy.addFuzzySet(0,1, &medioDireita);
  fuzzy.addFuzzySet(0,2, &longeDireita);
  
  //Entrada 1 - Sensor Esquerda
  fuzzy.addFuzzySet(1,0, &pertoEsquerda);
  fuzzy.addFuzzySet(1,1, &medioEsquerda);
  fuzzy.addFuzzySet(1,2, &longeEsquerda);
  
  //Saida - Giro
  fuzzy.addFuzzySet(2,0, &girarEsquerda);
  fuzzy.addFuzzySet(2,1, &girarPouco);
  fuzzy.addFuzzySet(2,2, &longeDireita);
  
  fuzzy.addRule(rule1);
  fuzzy.addRule(rule2);
  fuzzy.addRule(rule3);
  fuzzy.addRule(rule4);
  fuzzy.addRule(rule5);
  fuzzy.addRule(rule6);
  fuzzy.addRule(rule7);
  fuzzy.addRule(rule8);
  fuzzy.addRule(rule9);
  
  //forward(45);
}

void loop(){
  float rigthDistance = getDistanceByInfraredOn(IRRigthPin);
  float leftDistance = getDistanceByInfraredOn(IRLeftPin);
  
  fuzzy.setInputs(0, rigthDistance);
  fuzzy.setInputs(1, leftDistance);
  
  fuzzy.fuzzify(0);
  fuzzy.fuzzify(1);
  
  fuzzy.evaluate();
  
  //15.67, 16.38 -80
  
  //8.32 9.36 20
  //8.98 10.38 20
  
  float giro = fuzzy.desfuzzify();
  
  //bend(giro);
  
  contador = contador + 1;
  Serial.print("Contador: ");Serial.println(contador);
  Serial.print("Direita: ");Serial.println(rigthDistance);
  Serial.print("Esquerda: ");Serial.println(leftDistance);
  Serial.print("Giro: ");Serial.println(giro);
  Serial.println();
  delay(2000);
}

float getDistanceByInfraredOn(int infraredAnalogPin){
  float volts = analogRead(infraredAnalogPin) * valuePerStep;
  return THERETICAL_DISTANCE * pow(volts, VARIATION); // worked out from graph 65 = theretical distance / (1/Volts)S - luckylarry.co.uk
}

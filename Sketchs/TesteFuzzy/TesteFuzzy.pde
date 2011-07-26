#include <Fuzzy.h>

int teste = 0;
int ledPin = 13;
int tamanho = 100;
int v = 20;

Fuzzy fuzzy(1);

FuzzySet perto(0, 0, 25, 50);
FuzzySet medio(25, 50, 50, 75);
FuzzySet longe(50, 75, 100, 100);

void setup(){
  Serial.begin(9600);
  Serial.println("Ola mundo");  
  pinMode(ledPin, OUTPUT);
  
  
  //Index 0 - Input - Velocidade
  fuzzy.setFuzzySetsInput(0, 0, &perto);   //Set 1
  fuzzy.setFuzzySetsInput(0, 1, &medio);   //Set 2
  fuzzy.setFuzzySetsInput(0, 2, &longe);   //Set 3
}

void loop(){ 

 if (v > 100){
   v = 20;
 }
 fuzzy.setInputs(0,v);
 
 fuzzy.fuzzify(0);
 
 //fuzzy.evaluate();
 
 //float saida = fuzzy.desfuzzify();
 
 Serial.print("Entrada: ");
 Serial.println(v);
 Serial.println(fuzzy.getFuzzification(0,0)); 
 Serial.println(fuzzy.getFuzzification(0,1));
 Serial.println(fuzzy.getFuzzification(0,2));
 Serial.println("-");
 //Serial.print("Resultado: ");
 //Serial.println(saida);
 //Serial.println("---");
 //Serial.println();
 
 v = v + 1;  
 delay(2000);
}

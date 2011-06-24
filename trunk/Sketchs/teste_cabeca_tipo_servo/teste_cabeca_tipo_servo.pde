#include <Servo.h>

Servo head;
int incomingByte = 0;

void setup(){
  Serial.begin(9600);
  head.attach(11);
  menu();
}

void menu(){
    Serial.println("Insert the rotation value:");
}

void loop(){
  if(Serial.available()> 0){
    incomingByte = Serial.read();
    if(incomingByte != -1){
      switch(incomingByte){
        case 'q':
          head.write(170);
          Serial.println("170");
          break;
        case 'w':
          head.write(135);
          Serial.println("135");
          break;
        case 'e':
          head.write(90);
          Serial.println("90");
          break;
        case 'r':
          head.write(45);
          Serial.println("45");
          break;
        case 't':
          head.write(10);
          Serial.println("10");
          break;
        default:
          head.write(90);
          Serial.println("Def. 90");
      }
    }
  }
}

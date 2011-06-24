/*
  AJ Alves.
  aj.alves@live.com
*/
#include <Servo.h>

Servo rightWheel, leftWheel, head;
//int led = 13;
int flag = 0;
int i;  
int incomingByte = 0;  

void setup(){
  Serial.begin(9600);
  //pinMode(led, OUTPUT);
  rightWheel.attach(9);
  leftWheel.attach(10);
  //head.attach(13);
  menu();
}

void loop(){  
  if(Serial.available() > 0 ){  
    incomingByte = Serial.read();  
    if(incomingByte != -1){  
      Serial.println(incomingByte,BYTE);  
      //piscaled();
      switch(incomingByte){
        case '0':
          Serial.println("Right and left stoped");
          rightWheel.write(90);
          leftWheel.write(90);  
          break; 
        case '1':
          Serial.println("Right on a max speed counterclockwise, Left on max speed clockwise");
          rightWheel.write(0);
          leftWheel.write(180);  
          break;  
        case '2':  
          Serial.println("Right stoped, Left on a slow clockwise");
          rightWheel.write(90);
          leftWheel.write(135);
          break;
        case '3':
          Serial.println("Right and left on a max speed clockwise");
          rightWheel.write(180);
          leftWheel.write(180);
          break;
        case '4':
          Serial.println("Right on a slow counterclockwise, Left stoped");
          rightWheel.write(45);
          leftWheel.write(90);
          break;
        case '5':
          Serial.println("Right on a max speed clockwise, Left on a max speed counterclockwise");
          rightWheel.write(180);
          leftWheel.write(0);
          break;  
        default :  
          Serial.println("ERROR - Invalid input!");  
          break;  
      }
    }
  }  
}  

void menu() {  
  Serial.println("Robot - Continuous rotation servo motor test 1.0 (Right and Left Wheel)");
  Serial.println("Select :");
  Serial.println("0 - Right and left stoped"); 
  Serial.println("1 - Right on a max speed counterclockwise, Left on max speed clockwise");  
  Serial.println("2 - Right stoped, Left on a slow clockwise");  
  Serial.println("3 - Right and left on a max speed clockwise");  
  Serial.println("4 - Right on a slow counterclockwise, Left stoped");  
  Serial.println("5 - Right on a max speed clockwise, Left on a max speed counterclockwise");  
  Serial.println("-------------------------");  
}  

/*void piscaled() {  
  if( flag==0) {  
    digitalWrite(led,HIGH);  
    flag = 1;  
   }else{  
    digitalWrite(led,LOW);  
    flag = 0;  
  }  
}*/

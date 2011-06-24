/*
  AJ Alves.
  aj.alves@live.com
*/
#include <Servo.h>

Servo rightWheel, leftWheel;
int flag = 0, tokenPosition = 0, incomingByte = 0, robotSpeedValue = 0;
String incomingString, robotDirection, robotSpeed;  

void setup(){
  Serial.begin(9600);
  rightWheel.attach(9);
  leftWheel.attach(10);
  menu();
}

void menu() {
  Serial.println("Robot - Continuous rotation servo motor controller 1.0 (Right and Left Wheel)");
  Serial.println("Type the direction and speed for the robot walk:");
  Serial.println("Exemple: forward:fast");
  Serial.println("Direction legend:");
  Serial.println("         forward - The robot goes ahead.");
  Serial.println("         backward - The robot back in reverse gear.");
  Serial.println("Speed legend:");
  Serial.println("         fast - The robot goes in max speed.");
  Serial.println("         fastmedium - The robot goes in almost max speed.");
  Serial.println("         medium - The robot goes in medium speed.");
  Serial.println("         mediumslow - The robot goes in almost min speed.");
  Serial.println("         slow - The robot goes in min speed.");
  Serial.println("To stop: stop:stop");
  Serial.println("-------------------------");
}

void loop(){  
  if(Serial.available() > 0 ){  
    incomingByte = Serial.read();  
    if(incomingByte != -1){
      switch(incomingByte){
        case '1' :
          rightWheel.write(180);
          leftWheel.write(0);
          break;
        case '2' :
          rightWheel.write(158);
          leftWheel.write(22);
          break;
        case '3' :
          rightWheel.write(136);
          leftWheel.write(44);
          break;
        case '4' :
          rightWheel.write(114);
          leftWheel.write(66);
          break;
        case '5' :
          rightWheel.write(92);
          leftWheel.write(88);
          break;
        case '6' :
          rightWheel.write(0);
          leftWheel.write(180);
          break;
        case '7' :
          rightWheel.write(22);
          leftWheel.write(158);
          break;
        case '8' :
          rightWheel.write(44);
          leftWheel.write(136);
          break;
        case '9' :
          rightWheel.write(66);
          leftWheel.write(144);
          break;
        case '0' :
          rightWheel.write(88);
          leftWheel.write(92);
          break;
        default: 
          rightWheel.write(90);
          leftWheel.write(90);
      }
    }
  }  
}

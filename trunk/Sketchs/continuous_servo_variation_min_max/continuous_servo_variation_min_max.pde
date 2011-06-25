/*
  AJ Alves.
  aj.alves@live.com
*/
#include <Servo.h>
#include <Continuous2Wheels.h>

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
  Serial.println("Robot - Continuous rotation servo motor speed variation from min to max (Right and Left Wheel)");
  Serial.println("Type the direction and speed for the robot walk:");
  Serial.println("To Start: 1");
  Serial.println("To stop: 2");
  Serial.println("-------------------------");
}

void loop(){  
  if(Serial.available() > 0 ){  
    incomingByte = Serial.read();  
    if(incomingByte != -1){
      switch(incomingByte){
        case '1' :
          start();
          break;
        default:
        case '2' :
          stop();
          break;
      }
    }
  }
}

void start(){
  int speed = 0;
  for(int speed=0; speed<=90; speed = speed + 3){
    Serial.print("Speed on ");
    Serial.println(speed);
    rightWheel.write(90+speed);
    leftWheel.write(90-speed);
    delay(1000);
  }
  stop();
}

void stop(){
  rightWheel.write(90);
  leftWheel.write(90);
}

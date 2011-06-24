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
      incomingString = String(incomingByte);
      if(incomingString != -1){
        tokenPosition = incomingString.indexOf(':');
        robotDirection = incomingString.substring(0, tokenPosition);
        robotSpeed = incomingString.substring(tokenPosition, incomingString.length());
      }else{
        robotDirection = "null";
        robotSpeed = "null";
      }
      if(robotSpeed.equals("fast")){
           robotSpeedValue = 90;
      }else if(robotSpeed.equals("fastmedium")){
           robotSpeedValue = 68;
      }else if(robotSpeed.equals("medium")){
           robotSpeedValue = 46;
      }else if(robotSpeed.equals("mediumslow")){
           robotSpeedValue = 24;
      }else if(robotSpeed.equals("slow")){
           robotSpeedValue = 2;
      }else{
           robotSpeedValue = 0;
      }
      if(robotDirection.equals("forward")){
          rightWheel.write(90 + robotSpeedValue);
          leftWheel.write(90 - robotSpeedValue);
      }else if(robotDirection.equals("backward")){
          rightWheel.write(90 - robotSpeedValue);
          leftWheel.write(90 + robotSpeedValue);
      }else{
          rightWheel.write(90);
          leftWheel.write(90);
      }
    }
  }  
}

/*
  AJ Alves.
  aj.alves@live.com
*/
#include <Servo.h>

Servo rightWheel, leftWheel;

void setup(){
  rightWheel.attach(9);
  leftWheel.attach(10);
}

void loop(){
  rightWheel.write(0);
  leftWheel.write(180);
}

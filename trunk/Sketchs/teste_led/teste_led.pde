int ledPin = 7;
int ledPinBoard = 13;

void setup(){
  pinMode(ledPin, OUTPUT);
  pinMode(ledPinBoard, OUTPUT);
}

void loop(){
   digitalWrite(ledPinBoard, HIGH);
   digitalWrite(ledPin, LOW);
   delay(1000);
   digitalWrite(ledPinBoard, LOW);
   digitalWrite(ledPin, HIGH);
   delay(1000);
}

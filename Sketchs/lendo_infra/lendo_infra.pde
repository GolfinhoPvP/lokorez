int leftInfraredPin = 6, rightInfraredPin = 7;
float leftReadingVolts, rightReadingvolts;

void setup(){
  Serial.begin(9600);
}

void loop() {
  pinMode(leftReadingVolts, OUTPUT);
  pinMode(rightReadingvolts, OUTPUT);
  leftReadingVolts = digitalRead(leftInfraredPin);
  rightReadingvolts = digitalRead(rightInfraredPin);
  Serial.print(leftReadingVolts);
  Serial.print(" - ");
  Serial.println(rightReadingvolts);
  delay(1000);
}

int ir_receptor_d = 7;
int ir_receptor_e = 6;

int status_d;
int status_e;

void setup(){
  Serial.begin(9600);
  pinMode(ir_receptor_d, INPUT);
  pinMode(ir_receptor_e, INPUT);
}

void loop() {
  status_d = digitalRead(ir_receptor_d);
  status_e = digitalRead(ir_receptor_e);
  Serial.print("Rigth in: ");
  Serial.println(status_d);
  Serial.print("Left in: ");
  Serial.println(status_e);
  delay(100);
}

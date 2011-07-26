#define ANALOG_VARIATION 1024
#define VOLTAGE_USAGE 5.0
#define VARIATION -1.0
#define THERETICAL_DISTANCE 65

int IRRigthPin = 1; // analog pin for reading the IR sensor
int IRLeftPin = 2; // analog pin for reading the IR sensor
float valuePerStep = VOLTAGE_USAGE / ANALOG_VARIATION; // value from sensor * (5/1024) - if running 3.3.volts then change 5 to 3.3

void setup() {
  Serial.begin(9600);
}

void loop() {
  float rigthVolts = analogRead(IRRigthPin)*valuePerStep;
  float leftVolts = analogRead(IRLeftPin)*valuePerStep;
  float rigthDistance = THERETICAL_DISTANCE * pow(rigthVolts, VARIATION);          // worked out from graph 65 = theretical distance / (1/Volts)S - luckylarry.co.uk
  float leftDistance = THERETICAL_DISTANCE * pow(leftVolts, VARIATION);          // worked out from graph 65 = theretical distance / (1/Volts)S - luckylarry.co.uk
  Serial.print("Rigth distance: ");
  Serial.println(rigthDistance);
  Serial.print("Left distance: ");
  Serial.println(leftDistance);
  
  //Serial.print("Rigth distance: ");
  //Serial.println(read_distance(IRRigthPin));
  //Serial.print("Left distance: ");
  //Serial.println(read_distance(IRLeftPin));
  
  delay(1000);
}

float read_distance(int pin) {
  int val;
  val = analogRead(pin);
  if (val < 3)
    return -1; // invalid value
  return (6787.0/((float)val - 3.0)) - 4.0;
}

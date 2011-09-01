#define ANALOG_VARIATION 1024
#define VOLTAGE_USAGE 5.0
#define VARIATION -1.6
#define THERETICAL_DISTANCE 65

int IRRigthPin = 0; // analog pin for reading the IR sensor
int IRLeftPin = 1; // analog pin for reading the IR sensor
float valuePerStep = 0.0; // value from sensor * (5/1024) - if running 3.3.volts then change 5 to 3.3

void setup() {
  Serial.begin(9600);
  valuePerStep = VOLTAGE_USAGE / ANALOG_VARIATION;
}

void loop() {
  float rigthVolts = analogRead(IRRigthPin) * valuePerStep;
  float leftVolts = analogRead(IRLeftPin) * valuePerStep;
  float rigthDistance = THERETICAL_DISTANCE * pow(rigthVolts, VARIATION); // worked out from graph 65 = theretical distance / (1/Volts)S - luckylarry.co.uk
  float leftDistance = THERETICAL_DISTANCE * pow(leftVolts, VARIATION); // worked out from graph 65 = theretical distance / (1/Volts)S - luckylarry.co.uk
  
  Serial.print("Rigth distance: ");Serial.print(rigthDistance);Serial.print(" volts: ");Serial.println(rigthVolts);
  Serial.print("Left distance: ");Serial.print(leftDistance);Serial.print(" volts: ");Serial.println(leftVolts);
  
  delay(1000);
}

float getDistanceByInfraredOn(int infraredAnalogPin){
  float volts = analogRead(infraredAnalogPin) * valuePerStep;
  return THERETICAL_DISTANCE * pow(volts, VARIATION); // worked out from graph 65 = theretical distance / (1/Volts)S - luckylarry.co.uk
}

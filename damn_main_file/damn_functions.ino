void dcForward() { // fonction pour avancer 
 //// set forward motion for A and B

 Serial.print("avancer");
 digitalWrite(directionA, HIGH); //Establishes forward direction of Channel A
 digitalWrite(brakeA, LOW);   //Disengage the Brake for Channel A
 analogWrite(speedA, MAX_SPEED);
 digitalWrite(directionB, HIGH); //Establishes forward direction of Channel B
 digitalWrite(brakeB, LOW);   //Disengage the Brake for Channel B
 analogWrite(speedB, MAX_SPEED);
 moove = "forward";
}

void dcBackward() { // fonction pour reculer
   Serial.print("reculer");

 //// set backward motion for A and B
 digitalWrite(directionA, LOW); //Establishes forward direction of Channel A
 digitalWrite(brakeA, LOW);   //Disengage the Brake for Channel A
 analogWrite(speedA, MAX_SPEED);
 digitalWrite(directionB, LOW); //Establishes forward direction of Channel B
 digitalWrite(brakeB, LOW);   //Disengage the Brake for Channel B
 analogWrite(speedB, MAX_SPEED);
 moove = "backward";

}

void dcRight(){ // fonction pour tourner vers la droite
     Serial.print("tourner à droite");

 //// moteur A mouvement arrière, moteur B mouvement en avant
 digitalWrite(directionA, LOW); //Establishes forward direction of Channel A
 digitalWrite(brakeA, LOW);   //Disengage the Brake for Channel A
 analogWrite(speedA, MAX_SPEED);
  digitalWrite(directionB, HIGH); //Establishes forward direction of Channel B
 digitalWrite(brakeB, LOW);   //Disengage the Brake for Channel B
 analogWrite(speedB, MAX_SPEED);
 moove = "right";

}

void dcLeft() { // fonction pour tourner vers la gauche
       Serial.print("tourner à gauche");

   //// moteur A mouvement arrière, moteur B mouvement en avant
 digitalWrite(directionA, HIGH); //Establishes forward direction of Channel A
 digitalWrite(brakeA, LOW);   //Disengage the Brake for Channel A
 analogWrite(speedA, MAX_SPEED);
  digitalWrite(directionB, LOW); //Establishes forward direction of Channel B
 digitalWrite(brakeB, LOW);   //Disengage the Brake for Channel B
 analogWrite(speedB, MAX_SPEED);
 moove = "left";


}

void dcStop() { // fonction pour arrêter tout mouvement
         Serial.print("stop");

 //// stop motors A and B
 digitalWrite(brakeA, HIGH);   //Engage the Brake for Channel A
 analogWrite(speedA, 0);
 digitalWrite(brakeB, HIGH);   //Engage the Brake for Channel B
 analogWrite(speedB, 0);
 moove = "none";

}

bool checkDistance(int distance){
  if(distance <= 10){ moove = "stop"; return true;}
  else{return false;}
};

void mooveViaInstruction(char instruction){
  if (instruction == '1'){                             //si le message reçu est 1
    dcForward();                                 // Avancer
  }
  
  else if (instruction == '2'){                       //si le message reçu est 2
    dcBackward();                     // Reculer
  }
  
  
  else if (instruction == '3'){                            //si le message reçu est 3
    dcRight();           // Aller à droite
  }
  
  else if (instruction == '4'){                        //si le message reçu est 4
    dcLeft();          // aller à gauche
  }
  
  
  else if (instruction == '5'){                        //si le message reçu est 5
    dcStop();            //arrêter le déambulateur
  }
}

long readUltrasonicDistance(int triggerPin, int echoPin){
  pinMode(triggerPin, OUTPUT);  // Clear the trigger
  digitalWrite(triggerPin, LOW);
  delayMicroseconds(2);
  // Sets the trigger pin to HIGH state for 10 microseconds
  digitalWrite(triggerPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(triggerPin, LOW);
  pinMode(echoPin, INPUT);
  // Reads the echo pin, and returns the sound wave travel time in microseconds
  return pulseIn(echoPin, HIGH);
}

package com.reliantroster.app;

/* Calling imports Start */
import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.text.Html;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;
/* Calling imports End */

public class RegisterActivity extends Activity {
    EditText ET_NAME, ET_USER_NAME, ET_USER_EMAIL, ET_USER_PASS, ET_USER_PASS2; //Declare editText varailables
    String name, user_name, user_email, user_pass, user_pass2; //Declare string varailables
    boolean backbutton = true; //Declaring boolean backbutton to true

    @Override
    protected void onCreate(Bundle savedInstanceState) { //Creates code, elements beneath when RegisterActivity is ran
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register); //Setting view/styling to activity_register class
        ET_NAME = (EditText) findViewById(R.id.name); //initialising variable made above, linking it to ID
        ET_USER_NAME = (EditText) findViewById(R.id.new_user_name); //initialising variable made above, linking it to ID
        ET_USER_EMAIL = (EditText) findViewById(R.id.new_user_email); //initialising variable made above, linking it to ID
        ET_USER_PASS = (EditText) findViewById(R.id.new_user_pass); //initialising variable made above, linking it to ID
        ET_USER_PASS2 = (EditText) findViewById(R.id.new_user_pass2); //initialising variable made above, linking it to ID
    }

    public void userReg(View view) { //Onclick for employee registration button
        backbutton = true; //Set backButton to true
        if (CheckNetwork.isInternetAvailable(RegisterActivity.this)) { //Checks if there is internet connection on RegisterActivity class, returns true if internet available
            name = ET_NAME.getText().toString(); //initialising string variable made above
            user_name = ET_USER_NAME.getText().toString(); //initialising string variable made above
            user_email = ET_USER_EMAIL.getText().toString(); //initialising string variable made above
            user_pass = ET_USER_PASS.getText().toString(); //initialising string variable made above
            user_pass2 = ET_USER_PASS2.getText().toString(); //initialising string variable made above
            if (name.isEmpty() || user_name.isEmpty() || user_email.isEmpty() || user_pass.isEmpty()) { //Check if user_name or user_email or user_pass EditText values are empty
                Toast nothingEntered = Toast.makeText(RegisterActivity.this, "Please fill in the fields", Toast.LENGTH_SHORT); //If empty notify user with toast message to fill in register form
                nothingEntered.show(); //Output toast made above to screen
            } else if (!user_pass.equals(user_pass2)) { //If user_pass does not match user_pass2 EditText value run code beneath
                ET_USER_PASS2.setError(Html.fromHtml("<font color='red'>Passwords did not match</font>")); //Alert user that passwords did not match
            } else { //If name, user_name, user_email or user_pass is not empty
                String method = "register"; //Declaring method equals "register"
                BackgroundActivity BackgroundActivity = new BackgroundActivity(this); //Creating object of background task
                BackgroundActivity.execute(method, name, user_name, user_email, user_pass); //Execute the Async background task & pass in user information
                finish(); //This will close the activity and return to LoginActivity class
            }
        } else { //If there is no internet connection
            if (backbutton == true) { //And backbutton is true
                Toast.makeText(this, "No Internet Connection", Toast.LENGTH_LONG).show(); //Toast network connection error to user
                backbutton = false; //Set backbutton to false
            }
        }
    }

    public void registerReturn(View view) { //Onclick to return from employee registration
        startActivity(new Intent(this, LoginActivity.class)); //Start LoginActivity
    }

}


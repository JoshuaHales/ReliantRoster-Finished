package com.reliantroster.app;

/* Calling imports Start */
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Toast;
/* Calling imports End */

public class LoginActivity extends Activity {
    public EditText ET_NAME, ET_PASS; //Declaring editText varailables
    String login_name, login_pass; //Declaring string varailables
    boolean checkClicked = false; //Declaring boolean checkClicked to false
    CheckBox CheckBoxLogin; //Declaring CheckBox object
    boolean backbutton = true; //Declaring boolean backbutton to true

    @Override
    protected void onCreate(Bundle savedInstanceState) { //Creates code, elements beneath when LoginActivity is ran
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main_login); //Setting view/styling to activity_main_login class
        SharedPreferences sharedPreferences = getSharedPreferences("loginDetails", Context.MODE_PRIVATE); //Creating SharedPreferences value equals to values stored in SharedPreferences loginDetails
        Boolean checkClick2 = sharedPreferences.getBoolean("checkClicked1", checkClicked); //Creates boolean called checkClick2 that equals SharedPreferences checkbox value of checkClicked1 (READ)
        String userName2 = sharedPreferences.getString("userName1", ""); //Creates string called userName2 that equals SharedPreferences string value of userName1 (READ)
        String password2 = sharedPreferences.getString("password1", ""); //Creates string called password2 that equals SharedPreferences string value of password1 (READ)
        CheckBoxLogin = (CheckBox) findViewById(R.id.checkBoxLogin); //initialising checkbox variable made above, linking it to ID
        ET_NAME = (EditText) findViewById(R.id.user_name); //initialising String variable made above, linking it to ID
        ET_PASS = (EditText) findViewById(R.id.user_pass); //initialising String variable made above, linking it to ID
        if (userName2.equals("") || password2.equals("") || checkClick2 == false) { //Checks if userName2 equals null or password2 equals null of checkClick2 eqauls false run code beneath
            ET_NAME.setText(""); //Set string ET_NAME to null
            ET_PASS.setText(""); //Set string ET_PASS to null
            CheckBoxLogin.setChecked(false); //Set checkbox CheckBoxLogin to not clicked
        } else { //If statement hold values and are not null and checkbox is clicked run code beneath
            ET_NAME.setText(userName2); //Set string ET_NAME to value stored in userName2
            ET_PASS.setText(password2); //Set string ET_PASS to value stored in password2
            CheckBoxLogin.setChecked(true); //Set checkbox CheckBoxLogin to clicked
        }
    }

    public void userReg(View view) { //Onclick event for button userReg
        startActivity(new Intent(this, RegisterActivity.class)); //Start RegisterActivity class
    }

    public void saveUser(View view) { //Onclick event for checkbox saveUser
        if (!CheckBoxLogin.isChecked()) { //If CheckBoxLogin checkbox value is not checked
            checkClicked = false; //Set checkClicked to false
            SharedPreferences sharedPreferences = getSharedPreferences("loginDetails", Context.MODE_PRIVATE); //Creating SharedPreferences value equals to values stored in SharedPreferences loginDetails
            SharedPreferences.Editor editor = sharedPreferences.edit(); //Allowing shared SharedPreferences to be editable
            editor.putBoolean("checkClicked1", checkClicked); //Pushing value checkClicked1 into SharedPreferences (WRITE)
            editor.putString("userName1", ""); //Pushing value userName1 into SharedPreferences (WRITE)
            editor.putString("password1", ""); //Pushing value password1 into SharedPreferences (WRITE)
            editor.commit(); //Submit values above to SharedPreferences
        }
        if (CheckBoxLogin.isChecked()) { //If CheckBoxLogin is checked
            checkClicked = true; //Set checkClicked to true
        }
    }

    public void userLogin(View view) { //Onclick event for userLogin button
        backbutton = true; //Declaring boolean backbutton to true
        if (CheckNetwork.isInternetAvailable(LoginActivity.this)) {//Checks if there is internet connection on LoginActivity class, returns true if internet available
            login_name = ET_NAME.getText().toString(); //initialising string variable made above
            login_pass = ET_PASS.getText().toString(); //initialising string variable made above
            if (login_name.isEmpty() || login_pass.isEmpty()) { //Check if login_name or login_pass EditText values are empty
                Toast nothingEntered = Toast.makeText(LoginActivity.this, "Please fill in all fields", Toast.LENGTH_SHORT); //If empty notify user with toast message to fill in login form
                nothingEntered.show(); //Output toast made above to screen
            } else { //if login_name or login_pass EditText values are not empty
                String method = "login"; //Declaring method equals "login"
                BackgroundActivity BackgroundActivity = new BackgroundActivity(this); //Creating object of background task
                BackgroundActivity.execute(method, login_name, login_pass); //Execute the Async background task & pass in user information
                if (checkClicked == true) { //If checkClicked is true run code beneath
                    SharedPreferences sharedPreferences = getSharedPreferences("loginDetails", Context.MODE_PRIVATE); //Creating SharedPreferences value equals to values stored in SharedPreferences loginDetails
                    SharedPreferences.Editor editor = sharedPreferences.edit(); //Allowing shared SharedPreferences to be editable
                    editor.putBoolean("checkClicked1", checkClicked); //Pushing value CheckBox checkClicked into SharedPreferences (WRITE)
                    editor.putString("userName1", ET_NAME.getText().toString()); //Pushing EditText value ET_NAME into value userName1 storing into SharedPreferences (WRITE)
                    editor.putString("password1", ET_PASS.getText().toString()); //Pushing EditText value ET_PASS into value password1 storing into SharedPreferences (WRITE)
                    editor.commit(); //Submit values above to SharedPreferences
                }
            }
        } else { //If there is no internet connection
            if (backbutton == true) { //And backbutton is true
                Toast.makeText(this, "No Internet Connection", Toast.LENGTH_LONG).show(); //Toast network connection error to user
                backbutton = false; //Set backbutton to false
            }
        }
    }
}

package com.reliantroster.app;

/* Calling imports Start */
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;
/* Calling imports End */

public class MainActivity extends AppCompatActivity {
    boolean backbutton = true; //Declaring boolean backbutton to true

    @Override
    protected void onCreate(Bundle savedInstanceState) { //Creates code, elements beneath when LoginActivity is ran
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main); //Setting view/styling to activity_main class
        TextView myAwesomeTextView = (TextView) findViewById(R.id.noRosters); //Get TextView element and store in myAwesomeTextView
        myAwesomeTextView.setVisibility(View.INVISIBLE); //Make myAwesomeTextView invisible
        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.reloadBtn); //Get reference to FloatingActionButton icon by id
        fab.hide(); //Hide FloatingActionButton
        Intent i = getIntent(); //Create intent that equal intent made in BackgroundActivity
        int userId = i.getIntExtra(RosterListFragment.USER_ID_KEY, 0); //Create int that equals value of USER_ID_KEY
        FragmentManager fm = getSupportFragmentManager(); //Get Fragment support elements
        Fragment fragment = fm.findFragmentById(R.id.fragmentContainer); //Get fragment value by id
        if (fragment == null) { //If fragment returns null run code beneath
            fragment = RosterListFragment.newInstance(userId); //Create a new RosterListFragment instance with the value userId
            fm.beginTransaction() //Start fragment
                    .add(R.id.fragmentContainer, fragment) //add to fragment
                    .commit(); //Commit to fragment
        }
    }

    @Override
    public void onBackPressed() { //Onclick event for android backbutton press
        moveTaskToBack(true); //leaves your back stack as it is, just puts all Activities in background (same as if user pressed Home button).
    }

    public void onLogout() { //Onclick for ActionBar onLogout button
        AlertDialog.Builder builder = new AlertDialog.Builder(this); //Create a new dialog box
        builder.setTitle("Confirm"); //Set dialog box title
        builder.setMessage("Are you sure?"); //Set dialog box message
        builder.setPositiveButton("YES", new DialogInterface.OnClickListener() {

            public void onClick(DialogInterface dialog, int which) { //If yes click run logout code beneath
                dialog.dismiss(); //Dismiss dialog box
                SharedPreferences sharedPreferences = getSharedPreferences("loginDetails", Context.MODE_PRIVATE); //Creating SharedPreferences value equals to values stored in SharedPreferences loginDetails
                SharedPreferences.Editor editor = sharedPreferences.edit();
                //String userName2 = sharedPreferences.getString("userName1", ""); //Store values of user for username logged in
                //String password2 = sharedPreferences.getString("password1", ""); //Store values of user for password logged in
                editor.putString("userName1", ""); //Pushing null value to userName1 into SharedPreferences (WRITE)
                editor.putString("password1", ""); //Pushing null value to userName1 into SharedPreferences (WRITE)
                editor.commit(); //Submit values above to SharedPreferences
                Intent intent = new Intent(MainActivity.this, LoginActivity.class); //Create new intent for LoginActivity class
                startActivity(intent); //Run intent
                finish(); //Finish class
                Toast.makeText(MainActivity.this, "Logging out", Toast.LENGTH_LONG).show(); //Toast message to user notifying them of logging out
            }
        });
        builder.setNegativeButton("NO", new DialogInterface.OnClickListener() {  //If no click do nothing but close the dialog
            @Override
            public void onClick(DialogInterface dialog, int which) { //No click press
                dialog.dismiss(); // //Dismiss dialog box
            }
        });
        AlertDialog alert = builder.create(); //Build alert
        alert.show(); //Show alert on screen
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) { //Creates the options menu
        getMenuInflater().inflate(R.menu.main, menu); //Inflate the menu; this adds items to the action bar if it is present
        return true; //Return true
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) { //Create items options for menu
        switch (item.getItemId()) { //Handle item selection
            case R.id.logoutBtn: //If onclick for logout id
                onLogout(); //Runs onLogout() function above
                return true; //Return true
            default:
                return super.onOptionsItemSelected(item); //Create menu item options
        }
    }


    public void reloadList(View view) {
        backbutton = true; //Declaring boolean backbutton to true
        if (CheckNetwork.isInternetAvailable(MainActivity.this)) {//Checks if there is internet connection on MainActivity class, returns true if internet available
            Toast.makeText(MainActivity.this, "Refreshing rosters", Toast.LENGTH_LONG).show();
            finish();
            startActivity(getIntent());
        } else { //If there is no internet connection
            if (backbutton == true) { //And backbutton is true
                Toast.makeText(this, "No Internet Connection", Toast.LENGTH_LONG).show(); //Toast network connection error to user
                backbutton = false; //Set backbutton to false
            }
        }
    }
}

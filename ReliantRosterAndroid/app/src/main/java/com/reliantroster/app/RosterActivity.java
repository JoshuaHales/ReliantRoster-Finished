package com.reliantroster.app;

/* Calling imports Start */
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentManager;
import android.view.Menu;
import android.view.View;

import java.util.List;
/* Calling imports End */

public class RosterActivity extends FragmentActivity {
    public static final String EXTRA_ROSTER_ID = "roster_id"; //Declaring final string in to store rosterID
    public static int rosterId; //Create static int to store rosterID
    private List<Roster> mRosters; //Creates list to roster variable in value called mRosters

    @Override
    protected void onCreate(Bundle savedInstanceState) { //Creates code, elements beneath when RosterActivity is ran
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_roster); //Setting view/styling to activity_roster class
        fragment(); //Run fragment() function beneath
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) { //Creates the options menu
        getMenuInflater().inflate(R.menu.main, menu); //Inflate the menu; this adds items to the action bar if it is present
        return true; //Return true
    }

    private void fragment() { //Function called by the onCreate() function above
        FragmentManager fm = getSupportFragmentManager(); //Get support for FragmentManager
        Fragment fragment = fm.findFragmentById(R.id.fragmentContainer); //Set fragment value to ID of fragmentContainer

        if (fragment == null) { //If fragment is null run code beneath
            Intent i = getIntent(); //Get the intent
            rosterId = (Integer) i.getSerializableExtra(EXTRA_ROSTER_ID); //Set rosterId to int value of intentExtra EXTRA_ROSTER_ID
            fragment = RosterFragment.newInstance(rosterId); //Create new fragment with value of rosterId
            fm.beginTransaction() //Begin creating new fragment
                    .add(R.id.fragmentContainer, fragment) //Add fragment to fragmentContainer xml class
                    .commit(); //Commit new fragment
        }
    }

    public void onHomeButtonClick(View view) { //Onclick event Listener for onHomeButtonClick
        finish(); //Finish/close current fragment and return to mainActivity class
    }
}

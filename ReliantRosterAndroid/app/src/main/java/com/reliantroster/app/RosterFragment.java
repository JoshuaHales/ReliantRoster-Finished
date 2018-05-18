package com.reliantroster.app;

/* Calling imports Start */
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.TextView;

import java.util.List;
/* Calling imports End */

public class RosterFragment extends Fragment { //Created fragment class
    private static final String FRAGMENT_ROSTER_ID = "roster_id"; //Declaring final string in to store value called roster_id
    private int mRosterId; //Create int mRosterId
    private TextView mTitleField; //Creating TextView for each element from database
    private TextView mDescriptionField;
    private TextView mMondayField;
    private TextView mTuesdayField;
    private TextView mWednesdayField;
    private TextView mThursdayField;
    private TextView mFridayField;
    private TextView mSaturdayField;
    private TextView mSundayField;
    private TextView mTotalField;
    private Roster mRoster; //Creating new Roster object called mRoster
    private int mRosterPosition = -1; //Creating int called mRosterPosition to store current list position, set to -1
    private List<Roster> mRosters; //Creates list to roster variable in value called mRosters

    public static RosterFragment newInstance(int rosterId) {  //Creating new RosterFragment using the value of rosterId
        RosterFragment fragment = new RosterFragment(); //Create new fragment
        Bundle args = new Bundle(); //Bundle the arguments together for fragment
        args.putInt(FRAGMENT_ROSTER_ID, rosterId); //Set rosterId int value into args
        fragment.setArguments(args); //Set fragment with new arguments
        return fragment; //Return current fragment
    }

    @Override
    public void onCreate(Bundle savedInstanceState) { //Creates code, elements beneath when RosterFragment is ran
        super.onCreate(savedInstanceState);
        if (getArguments() != null) { //If arguments is not null
            mRosterId = getArguments().getInt(FRAGMENT_ROSTER_ID); //Set mRosterID value to args value of FRAGMENT_ROSTER_ID
        }
        ReliantRoster store = ReliantRoster.getInstance(); //Store current roster values
        mRosters = store.getRosters(); //Set mRosters to value stored in when getRosters() function is ran
        mRoster = null; //Set mRoster to null
        for (int i = 0; i != mRosters.size(); i++) { //Increase mRosters size until it matches how many values are pulled from database
            Roster r = mRosters.get(i); //Get value for mRosters and store in value of b
            if (r.getId() == mRosterId) { //If the value of getID matches value stored mRosterId run code beneath
                mRoster = r; //Set mRoster to value of the ID needed
                mRosterPosition = i; //Get the current list position
                break; //Break from current code
            }
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View fragment = inflater.inflate(R.layout.fragment_roster, container, false); //Creating current fragment with correct values beneath
        mTitleField = (TextView) fragment.findViewById(R.id.book_title_editText); //Creating references to TextView value ID retrieved from xml class
        mDescriptionField = (TextView) fragment.findViewById(R.id.roster_description_editText);
        mMondayField = (TextView) fragment.findViewById(R.id.roster_monday_editText);
        mTuesdayField = (TextView) fragment.findViewById(R.id.roster_tuesday_editText);
        mWednesdayField = (TextView) fragment.findViewById(R.id.roster_wednesday_editText);
        mThursdayField = (TextView) fragment.findViewById(R.id.roster_thursday_editText);
        mFridayField = (TextView) fragment.findViewById(R.id.roster_friday_editText);
        mSaturdayField = (TextView) fragment.findViewById(R.id.roster_saturday_editText);
        mSundayField = (TextView) fragment.findViewById(R.id.roster_sunday_editText);
        mTotalField = (TextView) fragment.findViewById(R.id.roster_total_editText);
        final ImageButton leftBtn = (ImageButton) fragment.findViewById(R.id.leftArrow); //Get reference to left arrow buttons
        ImageButton rightBtn = (ImageButton) fragment.findViewById(R.id.rightArrow); //Get reference to right arrow buttons

        leftBtn.setOnClickListener(new View.OnClickListener() { //Creating onClick event listener for leftBtn click
            @Override
            public void onClick(View v) {
                moveLeft(); //If clicked run moveLeft() function
            }
        });

        rightBtn.setOnClickListener(new View.OnClickListener() { //Creating onClick event listener for rightBtn click
            @Override
            public void onClick(View v) {
                moveRight(); //If clicked run moveRight() function
            }
        });

        populate(); //Run populate function below

        return fragment;
    }

    private void populate() { //Fills TextView values with retrieve values from database
        if (mRoster != null) { //If mRoster is null run code beneath
            mTitleField.setText(mRoster.getTitle()); //Setting TextView values for each element on the screen
            mDescriptionField.setText(mRoster.getDescription()); //Shows week value dates e.g (21-18)
            mMondayField.setText(mRoster.getMonday());
            mTuesdayField.setText(mRoster.getTuesday());
            mWednesdayField.setText(mRoster.getWednesday());
            mThursdayField.setText(mRoster.getThursday());
            mFridayField.setText(mRoster.getFriday());
            mSaturdayField.setText(mRoster.getSaturday());
            mSundayField.setText(mRoster.getSunday());
            mTotalField.setText(mRoster.getTotal() + "hrs"); //Append hrs value to end of total value
        }
    }

    private void moveLeft() { //Called by leftBtn click
        if (mRosterPosition > 0) { //If current mRosterPosition is greater then 0
            mRosterPosition--; //Decrease mRosterPosition by 1
            mRoster = mRosters.get(mRosterPosition); //Set mRoster to new current mRosterPosition position
            populate(); //re-run populate() function to update fragment with new values
        }
    }

    private void moveRight() { //Called by rightBtn click
        if (mRosterPosition < mRosters.size() - 1) { //If mRosterPosition is less then current mRosters size minus 1
            mRosterPosition++; //Increase mRosterPosition by 1
            mRoster = mRosters.get(mRosterPosition); //Set mRoster to new current mRosterPosition position
            populate(); //re-run populate() function to update fragment with new values
        }
    }
}

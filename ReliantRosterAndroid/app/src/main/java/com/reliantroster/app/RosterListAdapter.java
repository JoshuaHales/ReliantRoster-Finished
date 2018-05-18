package com.reliantroster.app;

/* Calling imports Start */
import java.util.List;

import android.app.Activity;
import android.content.Context;
import android.graphics.Color;
import android.support.design.widget.FloatingActionButton;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ListAdapter;
import android.widget.TextView;
/* Calling imports End */

public class RosterListAdapter extends ArrayAdapter<Roster>
        implements ListAdapter {
    private Activity mContext; //Creating activity called mContext
    private List<Roster> mRosters; //Creates list to roster variable in value called mRosters
    private boolean secondColor = false; //Creating boolean called secondColor and setting to false

    public RosterListAdapter(Context context, List<Roster> rosters) { //Creating RosterListAdapter which takes list and context values
        super(context, R.layout.list_item_roster, rosters);
        mContext = (Activity) context; //Set mContext to activity context
        mRosters = rosters; //Set mRosters to rosters list values
        FloatingActionButton fab = (FloatingActionButton) mContext.findViewById(R.id.reloadBtn); //Get reference to FloatingActionButton by ID of reloadBtn
        fab.show(); //Show FloatingActionButton in activity
        if (mRosters.isEmpty()) { //If mRosters list value is empty
            TextView myAwesomeTextView = (TextView) mContext.findViewById(R.id.noRosters); //Get reference to TextView by ID of noRosters
            myAwesomeTextView.setVisibility(View.VISIBLE); //Makes TextView above visible on activity
        }
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) { //Create the current list view
        if (convertView == null) { //If there is no view, inflate/create one
            LayoutInflater inflater = mContext.getLayoutInflater(); //Creating the new view
            convertView = inflater.inflate(R.layout.list_item_roster, null); //Set view for layout list_item_roster xml class
        }
        Roster bk = mRosters.get(position); //Configuring the current view for the weekly rosters
        TextView titleTextView = (TextView) convertView.findViewById(R.id.list_item_roster_title_textView); //Creating titleTextView using ID value of list_item_roster_title_textView
        titleTextView.setPadding(20, 30, 30, 0); //Set titleTextView view to have certain padding
        titleTextView.setText("Week: " + bk.getTitle()); //Append week before title value
        if (secondColor == false) { //If second color is false run code beneath
            titleTextView.setBackgroundColor(Color.rgb(255, 255, 255)); //Set titleTextView view to have certain background color
            titleTextView.setTextColor(Color.rgb(0, 188, 212)); //Set titleTextView view text to have certain color
            secondColor = true; //Set secondColor to true
        } else { //If second color is true run code beneath
            titleTextView.setBackgroundColor(Color.rgb(242, 242, 242)); //Set titleTextView view to have another certain background color
            titleTextView.setTextColor(Color.rgb(0, 188, 212)); //Set titleTextView view text to have another certain color
            secondColor = false; //Set secondColor to false
        }
        return convertView; //Return convertView
    }
}
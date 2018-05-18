package com.reliantroster.app;

/* Calling imports Start */
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.ListFragment;
import android.util.Log;
import android.view.View;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.Toast;

import com.reliantroster.app.http.HttpClient;
import com.reliantroster.app.http.HttpException;
import com.reliantroster.app.http.HttpRequest;
import com.reliantroster.app.http.HttpResponse;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.net.URI;
import java.net.URISyntaxException;
import java.util.ArrayList;
import java.util.List;
/* Calling imports End */

public class RosterListFragment extends ListFragment {
    public static final String USER_ID_KEY = "user_id"; //Declaring final string in to store value called roster_id
    private final String API_URL = "http://172.17.0.31/~n00133834/ReliantRosterWebApp/api"; //College
    //private final String API_URL = "http://192.168.1.132/ReliantRosterWebApp/api"; //Home Local
    private final String TAG = "ReliantRosterAndroidApp"; //Creating string called TAG
    private int mUserId; //Creating int that equals mUserId
    private List<Roster> mRosters; //Creates list to roster variable in value called mRosters

    public static RosterListFragment newInstance(int userId) { //Creating new RosterListFragment
        RosterListFragment fragment = new RosterListFragment(); //Create fragment
        Bundle args = new Bundle(); //Bundle the arguments together for fragment
        args.putInt(USER_ID_KEY, userId); //Set userId int value into args
        fragment.setArguments(args); //Set fragment with new arguments
        return fragment; //Return current fragment
    }

    private class HttpRequestTask extends AsyncTask<HttpRequest, Integer, HttpResponse> { //Running HttpRequestTask() function (PULLS DATA FROM DATABASE)
        @Override
        public HttpResponse doInBackground(HttpRequest... requests) {
            HttpClient client; //Allow the client
            HttpRequest request; //allow the request
            HttpResponse response = null; //Set response to null
            client = new HttpClient(); //Set client to new client
            request = requests[0]; //Set request to request[0]
            try {
                response = client.execute(request); //Try get response when executing request
            } catch (HttpException e) { //Catch the http exception if connection has failed
                String errorMessage = "Error downloading rosters: " + e.getMessage(); //Create string to error message received
                Log.d(TAG, "HttpClient: " + errorMessage); //Output error message to log
            }
            return response; //Return the response
        }
        @Override
        public void onPostExecute(HttpResponse response) { //Runs after executing
            onHttpResponse(response); //Runs onHttpResponse with value of response retrieved above
        }
    }

    public void onCreate(Bundle savedInstanceState) { //Creates code, elements beneath when RosterListFragment is ran
        super.onCreate(savedInstanceState);
        if (getArguments() != null) { //If getArguments is not null run code beneath
            mUserId = getArguments().getInt(USER_ID_KEY); //Set mUserId value to int value USER_ID_KEY stored in getArguments() function
        } else { //If getArguments is null run code beneath
            mUserId = 0; //Set mUserId to 0
        }
        String urlString = null; //Declare string urlString to null
        URI uri; //Declare a new URi
        HttpRequest request; //Declare a new HttpRequest
        HttpRequestTask t; //Declare a new HttpRequestTask
        try { //Try connect to Uri set below
            urlString = API_URL + "/roster/" + mUserId; //Set urlString to current API_URL set above plus roster then append the current mUserId
            uri = new URI(urlString); //Create the new Uri
            request = new HttpRequest("GET", uri); //Request connection to uri with get request
            t = new HttpRequestTask(); //Declare t that takes reference to a new HttpRequestTask
            t.execute(request); //Start the new HttpRequestTask
        } catch (URISyntaxException e) { //If connection to Uri set below fails run code beneath
            String errorMessage = "Error parsing uri (" + urlString + "): " + e.getMessage(); //Create string to error message received
            Log.d(TAG, "HttpClient: " + errorMessage); //Output error message to log
        }
    }

    @Override
    public void onListItemClick(ListView l, View v, int position, long id) { //Onclick event for item list click takes list position and rosterID values
        Roster r = (Roster) (getListAdapter()).getItem(position); //Create Roster which gets position of current list item clicked on
        Intent i = new Intent(getActivity(), RosterActivity.class); //Start new intent to RosterActivity class
        i.putExtra(RosterActivity.EXTRA_ROSTER_ID, r.getId()); //Pass extra to RosterActivity class to value of EXTRA_ROSTER_ID with value of rosterID from get method
        startActivity(i); //Start RosterActivity class
    }

    public void onHttpResponse(HttpResponse response) { //Response made from URI server
        JSONArray jsonArray; //Start a JSONArray to hold new JSON values
        JSONObject jsonObject; //Start a new JSONObject
        Roster roster; //Create new roster
        if (response != null) { //If response is not null
            if (response.getStatus() == 200) { //And retrieves status of 200(Ok)
                String body = response.getBody(); //Get the body of the JSON response
                try { //Try to pull new JSON objects values from reponse
                    jsonArray = new JSONArray(body); //Place new JSON objects from body of reponse and place into JSON array made above
                    mRosters = new ArrayList<Roster>(); //Creates list to roster variable in value called mRosters
                    for (int i = 0; i != jsonArray.length(); i++) { //As long i does not match the lenght of the JSON array add one to i
                        jsonObject = jsonArray.getJSONObject(i); //Create new JSON object for i element that is made
                        int id = jsonObject.getInt("rosterID"); //Pull each value from the JSON object body reponse that pulls from the database for each element below
                        String title = jsonObject.getString("title");
                        String description = jsonObject.getString("description");
                        String monday = jsonObject.getString("monday");
                        String tuesday = jsonObject.getString("tuesday");
                        String wednesday = jsonObject.getString("wednesday");
                        String thursday = jsonObject.getString("thursday");
                        String friday = jsonObject.getString("friday");
                        String saturday = jsonObject.getString("saturday");
                        String sunday = jsonObject.getString("sunday");
                        String total = jsonObject.getString("total");
                        roster = new Roster(id, title, description, monday, tuesday, wednesday, thursday, friday, saturday, sunday, total); //Placing new values into roster array
                        mRosters.add(roster); //Add roster to mRosters list
                    }
                } catch (JSONException e) { //If not values are pulled from the response run code beneath
                    String message = "Error retrieving rosters: " + e.getMessage(); //Create string to error message received
                    Toast.makeText(this.getActivity(), message, Toast.LENGTH_LONG).show(); //Output error message to log
                }
                ReliantRoster store = ReliantRoster.getInstance(); //Create store which takes instance of ReliantRoster
                store.setRosters(mRosters); //Set store to values of mRosters
                ListAdapter adapter = new RosterListAdapter(getActivity(), mRosters); //Create ListAdapter to RosterListAdapter with new mRosters values
                setListAdapter(adapter); //Set current list adapter with new values
            } else { //If response is null
                Log.d(TAG, "Http Response: " + response.getStatus() + " " + response.getDescription()); //Log output error message with the response status and description
            }
        }
    }
}

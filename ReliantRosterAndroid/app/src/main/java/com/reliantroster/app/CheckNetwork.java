package com.reliantroster.app;

/* Calling imports Start */
import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.util.Log;
/* Calling imports End */

public class CheckNetwork { //Checks network connection of project
    private static final String TAG = CheckNetwork.class.getSimpleName(); //Create string called TAG which gets simple name value when code is run


    public static boolean isInternetAvailable(Context context) //Code to check if there is a network connection or not
    {
        NetworkInfo info = ((ConnectivityManager)
                context.getSystemService(Context.CONNECTIVITY_SERVICE)).getActiveNetworkInfo(); //Network value that stores value of current network status

        if (info == null) //If info value is null
        {
            Log.d(TAG, "no internet connection"); //Notify user of no internet connection
            return false; //Return false
        } else //If info value is not null
        {
            if (info.isConnected()) //If info value is connected
            {
                Log.d(TAG, " internet connection available..."); //Notify user of available network connection
                return true; //Return true
            } else {
                Log.d(TAG, " internet connection"); //Notify user application is connected to network
                return true; //Return true
            }

        }
    }
}

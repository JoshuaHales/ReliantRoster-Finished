package com.reliantroster.app;

/* Calling imports Start */
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
/* Calling imports End */

public class BackgroundActivity extends AsyncTask<String, Void, String> {
    Context ctx; //Declaring context variable called ctx
    String method; //Declaring string variable called method

    BackgroundActivity(Context ctx) {
        this.ctx = ctx; //Declaring backgroundActivity context equals ctx value declared above
    }

    @Override
    protected String doInBackground(String... params) { //Main code to run in AsyncTask passing in method value
        //String reg_url = "http://192.168.1.132/ReliantRosterWebApp/api/register.php"; //Declaring variable URL for register, using localhost
        //String login_url = "http://192.168.1.132/ReliantRosterWebApp/api/login.php"; //Declaring variable URL for login, using localhost
        //String reg_url = "http://172.17.0.31/~n00134315/RELIANT_ROSTER_PROJECT/reliantRoster_app/register.php"; //Declaring variable URL for register, using College R
        //String login_url = "http://172.17.0.31/~n00134315/RELIANT_ROSTER_PROJECT/reliantRoster_app/login.php"; //Declaring variable URL for login, using College R
        String reg_url = "http://172.17.0.31/~n00133834/ReliantRosterWebApp/api/register.php"; //Declaring variable URL for register, using College R
        String login_url = "http://172.17.0.31/~n00133834/ReliantRosterWebApp/api/login.php"; //Declaring variable URL for login, using College R
        //String reg_url = "http://172.17.0.31/~n00133834/ReliantRoster/reliantRoster_app/register.php"; //Declaring variable URL for register, using College J
        //String login_url = "http://172.17.0.31/~n00133834/ReliantRoster/reliantRoster_app/login.php"; //Declaring variable URL for login, using College J
        method = params[0]; //Declaring variable called method that is equal to params[0]
        if (method.equals("register")) { //Check if method varaible made above is equal to register value
            String name = params[1]; //Declaring variable called name that is equal to params[1]
            String user_name = params[2]; //Declaring variable called user_name that is equal to params[2]
            String user_email = params[3]; //Declaring variable called user_email that is equal to params[3]
            String user_pass = params[4]; //Declaring variable called user_pass that is equal to params[4]
            try {
                URL url = new URL(reg_url); //Creating a new URL, pass in the registration URL
                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection(); //Open the connection
                httpURLConnection.setRequestMethod("POST"); //Use the POST methode
                httpURLConnection.setDoOutput(true); //Set output to true as data is being outputed for register
                OutputStream OS = httpURLConnection.getOutputStream(); //Get the ouput stream
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(OS, "UTF-8")); //Pass in the ecoding format
                String data = URLEncoder.encode("user", "UTF-8") + "=" + URLEncoder.encode(name, "UTF-8") + "&" + //Enoding information
                        URLEncoder.encode("user_name", "UTF-8") + "=" + URLEncoder.encode(user_name, "UTF-8") + "&" +
                        URLEncoder.encode("user_email", "UTF-8") + "=" + URLEncoder.encode(user_email, "UTF-8") + "&" +
                        URLEncoder.encode("user_pass", "UTF-8") + "=" + URLEncoder.encode(user_pass, "UTF-8");
                bufferedWriter.write(data); //Passing information into bufferwritter
                bufferedWriter.flush(); //Passing the information to the database
                bufferedWriter.close(); //Close the buffer
                OS.close(); //Close the output stream
                InputStream IS = httpURLConnection.getInputStream(); //Create input stream to get response from the database
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(IS, "iso-8859-1")); //Read input then encode
                String response = ""; //Create response varaible
                String line = ""; //Create line varaible
                while ((line = bufferedReader.readLine()) != null) { //As long as input stream is not null
                    response += line; //Append line to response
                }
                bufferedReader.close(); //Close the buffer
                IS.close(); //Close the input stream
                httpURLConnection.disconnect(); //Disconnect from URL
                //return "Registration Success..."; //Return registration success to user
                return response; //Return the response
            } catch (MalformedURLException e) { //Excerption handling
                e.printStackTrace();
            } catch (IOException e) { //Excerption handling
                e.printStackTrace();
            }
        } else if (method.equals("login")) { //Check if method varaible made above is equal to login value
            String login_name = params[1]; //Declaring variable called login_name that is equal to params[1]
            String login_pass = params[2];   //Declaring variable called login_pass that is equal to params[2]
            try {
                URL url = new URL(login_url); //Creating a new URL, pass in the registration URL
                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection(); //Open the connection
                httpURLConnection.setRequestMethod("POST"); //Use the POST methode
                httpURLConnection.setDoOutput(true); //Set output to true as data is being outputed for login
                httpURLConnection.setDoInput(true); //Set input to true to get response from server for login
                OutputStream outputStream = httpURLConnection.getOutputStream(); //Get the ouput stream
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8")); //Pass in the ecoding format
                String data = URLEncoder.encode("login_name", "UTF-8") + "=" + URLEncoder.encode(login_name, "UTF-8") + "&" + //Enoding information
                        URLEncoder.encode("login_pass", "UTF-8") + "=" + URLEncoder.encode(login_pass, "UTF-8");
                bufferedWriter.write(data); //Passing information into bufferwritter
                bufferedWriter.flush(); //Passing the information to the database
                bufferedWriter.close(); //Close the buffer
                outputStream.close(); //Close the output stream
                InputStream inputStream = httpURLConnection.getInputStream(); //Create input stream to get response from the database
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "iso-8859-1")); //Read input then encode
                String response = ""; //Create response varaible
                String line = ""; //Create line varaible
                while ((line = bufferedReader.readLine()) != null) { //As long as input stream is not null
                    response += line; //Append line to response
                }
                bufferedReader.close(); //Close the buffer
                inputStream.close(); //Close the input stream
                httpURLConnection.disconnect(); //Disconnect from URL
                return response;    //Return the response
            } catch (MalformedURLException e) { //Excerption handling
                e.printStackTrace();
            } catch (IOException e) { //Excerption handling
                e.printStackTrace();
            }
        }
        return null; //Else return null
    }

    @Override
    protected void onProgressUpdate(Void... values) {
        super.onProgressUpdate(values); //Publish update values to UI thread
    }

    @Override
    protected void onPostExecute(String result) { //Runs when BackgroundActivity is done exacuting using value result
        if (method.equals("login")) { //Checks if method value equals login
            try { //Placing code in try/catch statment
                JSONObject jsObject = new JSONObject(result); //Creates JSON object of value result
                int status = 0; //Create int called status that is 0
                try { //Placing code in try/catch statment
                    status = jsObject.getInt("status"); //Make status int equals to JSON value of status
                } catch (JSONException e) { //If fails use a exception handler for the JSON object
                    status = 500; //Make status equals to 500(Internal Server Error)
                }
                if (status == 200 && method.equals("login")) { //If status equals to 200(OK) and method equals login run below code
                    String userName = jsObject.getString("name"); //Create string called userName that equals JSON value retrieved of name
                    Toast.makeText(ctx, "Welcome: " + userName, Toast.LENGTH_LONG).show(); //If all is ok output toast to user notify them of the successful login
                    int id = jsObject.getInt("id"); //Create int called id that equals JSON value retrived of id of the employee logging in
                    Intent i = new Intent(ctx, MainActivity.class); //Start new intent to MainActivity.class
                    i.putExtra(RosterListFragment.USER_ID_KEY, id); //Pass extra to RosterListFragment class to value of USER_ID_KEY with value of id made above
                    ctx.startActivity(i); //start MainActivity class
                } else if (status == 403 && method.equals("login")) { //If status equals 403(Forbidden) and method equals login then run code below
                    Toast.makeText(ctx, "Incorrect username/password", Toast.LENGTH_LONG).show(); //Output toast to user notifying them that either username or password does not match any store on the server
                } else { //If result is does not come back with the above status codes
                    Toast.makeText(ctx, "Connection Error", Toast.LENGTH_LONG).show(); //Notify the user with a toast message that there has been a connection error.
                }
            } catch (JSONException e) { //If fails use a exception handler for the JSON object
                Toast.makeText(ctx, "JSONException: " + e.getMessage(), Toast.LENGTH_LONG).show(); //Notify the user with a toast of the exception/error that happened
            }
        } else if (method.equals("register")) { //Checks if method value is register
            if (result.equals("")) { //Checks if result value is null
                Toast.makeText(ctx, "Connection Error", Toast.LENGTH_LONG).show(); //If result is null output toast message to user
            } else if (result.equals("User Already exists")) { //If result equals value shown
                Toast.makeText(ctx, "User Already exists", Toast.LENGTH_LONG).show(); //If result matches username already register output toast to user
            } else { //If result is ok on not one of the above
                Toast.makeText(ctx, result, Toast.LENGTH_LONG).show(); //Output toast notifying user has been registered
            }
        }
    }
}

package com.reliantroster.app;

/* Calling imports Start */
import java.util.List;
/* Calling imports End */

public class ReliantRoster {
    private static ReliantRoster instance = null; //Create static ReliantRoster instance set to null
    private List<Roster> mRosters; //Create list whick stores values of roster called myRosters
    private ReliantRoster() {}
    public static ReliantRoster getInstance() {
        if (instance == null) { //If instance is null
            instance = new ReliantRoster(); //Create new ReliantRoster instance
        }
        return instance; //Return instance
    }

    public List<Roster> getRosters() {
        return mRosters; //Return mRosters list values
    }

    public void setRosters(List<Roster> mRosters) {
        this.mRosters = mRosters; //Create reference to mRosters for this class
    }
}

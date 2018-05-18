package com.reliantroster.app.http;



import com.reliantroster.app.Roster;

import java.util.List;

/**
 * Created by N00133834 on 02/02/2016.
 */
public class RosterOffice {
    private static RosterOffice instance = null;

    public static RosterOffice getInstance() {
        if (instance == null) {
            instance = new RosterOffice();
        }
        return instance;
    }

    private List<Roster> mRosters;

    private RosterOffice() {}

    public List<Roster> getRosters() {
        return mRosters;
    }

    public void setRosters(List<Roster> mRosters) {
        this.mRosters = mRosters;
    }
}

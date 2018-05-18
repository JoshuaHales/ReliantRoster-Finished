package com.reliantroster.app;

public class Roster { //Roster class stores reference to all database variables
    private int rId; //Declaring int rosterID
    private String rTitle; //Declaring String variables below
    private String rDescription;
    private String rMonday;
    private String rTuesday;
    private String rWednesday;
    private String rThursday;
    private String rFriday;
    private String rSaturday;
    private String rSunday;
    private String rTotal;

    public Roster(int rosterID, String title, String description, String monday, String tuesday, String wednesday, String thursday, String friday, String saturday, String sunday, String total) {
        rId = rosterID; //rId getting reference to int rosterID
        rTitle = title; //String variable above getting reference to roster string variable for each one
        rDescription = description;
        rMonday = monday;
        rTuesday = tuesday;
        rWednesday = wednesday;
        rThursday = thursday;
        rFriday = friday;
        rSaturday = saturday;
        rSunday = sunday;
        rTotal = total;
    }

    public Roster(String title, String description, String monday, String tuesday, String wednesday, String thursday, String friday, String saturday, String sunday, String total) {
        this(-1, title, description, monday, tuesday, wednesday, thursday, friday, saturday, sunday, total); //Placing values into roster class.
    }

    public int getId() {
        return rId;
    } //Returns rId value when getId() is called

    public String getTitle() {
        return rTitle;
    } //Returns rTitle value when getTitle() is called

    public void setTitle(String rTitle) {
        this.rTitle = rTitle;
    } //Sets rTitle when setTitle() is called

    public String getDescription() {
        return rDescription;
    } //Returns rDescription value when getDescription() is called

    public String getMonday() {
        return rMonday;
    } //Returns rMonday value when getMonday() is called

    public String getTuesday() {
        return rTuesday;
    } //Returns rTuesday value when getTuesday() is called

    public String getWednesday() {
        return rWednesday;
    } //Returns rWednesday value when getWednesday() is called

    public String getThursday() {
        return rThursday;
    } //Returns rThursday value when getThursday() is called

    public String getFriday() {
        return rFriday;
    } //Returns rFriday value when getFriday() is called

    public String getSaturday() {
        return rSaturday;
    } //Returns rSaturday value when getSaturday() is called

    public String getSunday() {
        return rSunday;
    } //Returns rSunday value when getSunday() is called

    public String getTotal() {
        return rTotal;
    } //Returns rTotal value when getTotal() is called
}

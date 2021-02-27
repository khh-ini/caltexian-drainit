package com.azizapp.test

import android.content.Context
import android.content.SharedPreferences
import android.preference.PreferenceManager

class SaveSharedPreference {
    val PREF_EMAIL = "email"
    fun getSharedPreferences(ctx: Context?): SharedPreferences {
        return PreferenceManager.getDefaultSharedPreferences(ctx)
    }

    fun setEmail(ctx: Context?, email: String?) {
        val editor: SharedPreferences.Editor = getSharedPreferences(ctx).edit()
        editor.putString(PREF_EMAIL, email)
        editor.commit()
    }

    fun getEmail(ctx: Context?): String? {
        return getSharedPreferences(ctx)
            .getString(PREF_EMAIL, "")
    }
}
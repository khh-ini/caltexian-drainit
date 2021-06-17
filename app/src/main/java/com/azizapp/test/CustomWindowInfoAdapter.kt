package com.azizapp.test

import android.app.Activity
import android.content.Context
import android.view.View
import android.widget.TextView
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.model.Marker

class CustomWindowInfoAdapter(context: Context) : GoogleMap.InfoWindowAdapter {

    var mContext = context
    var mWindow = (context as Activity).layoutInflater.inflate(R.layout.custom_info_layout, null)

    private fun rendowWindowText(marker: Marker, view: View) {
        val title = marker.title
        val tvTitle = view.findViewById<TextView>(R.id.tvTitleMarker)
        if (title != "") {
            tvTitle.text = title
        }

        val snippet = marker.snippet
        val tvSnippet = view.findViewById<TextView>(R.id.tvSnippet)

        if (snippet != "") {
            tvSnippet.text = snippet
        }
        //val image = view.findViewById<ImageView>(R.id.imageInfo)
    }

    override fun getInfoContents(marker: Marker): View {
        rendowWindowText(marker, mWindow)
        return mWindow
    }

    override fun getInfoWindow(marker: Marker): View? {
        rendowWindowText(marker, mWindow)
        return mWindow
    }
}
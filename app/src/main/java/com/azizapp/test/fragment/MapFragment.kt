package com.azizapp.test.fragment

import android.content.Intent
import android.os.Bundle
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.azizapp.test.R
import com.google.android.gms.maps.*
import com.google.android.gms.maps.model.LatLng
import com.google.android.gms.maps.model.Marker
import kotlinx.android.synthetic.main.fragment_home.*
import kotlinx.android.synthetic.main.fragment_map.*


class MapFragment : AppCompatActivity(), OnMapReadyCallback {

    private lateinit var mMap: GoogleMap
    private lateinit var marker : Marker
    private lateinit var lat:String
    private lateinit var lang:String


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.fragment_map)
        // Inflate the layout for this fragment
        map.onCreate(savedInstanceState)
        map.onResume()

        map.getMapAsync(this)

        btn_konfirmasi.setOnClickListener {
//            val intent = Intent(this, LaporanFragment::class.java)
//            intent.putExtra("latLng", latLng)
            val newBundle = Bundle().apply {
                putString("lat", lat)
                putString("lang", lang)
            }
            val objects = LaporanFragment()
            objects.arguments = newBundle

            val intent = Intent(this, LaporanFragment::class.java)
            intent.putExtras(newBundle)
            startActivity(intent)
        }
    }

    override fun onMapReady(googleMap: GoogleMap) {
        mMap = googleMap
        val pekanbaru = LatLng(0.510440, 101.438309)

        googleMap.moveCamera(CameraUpdateFactory.newLatLng(pekanbaru))
        googleMap.animateCamera(CameraUpdateFactory.zoomTo(12.0f))
        googleMap.setOnMapClickListener { point ->
            Toast.makeText(
                this,
                point.latitude.toString() + ", " + point.longitude,
                Toast.LENGTH_SHORT
            ).show()
            lat=point.latitude.toString()
            lang=point.longitude.toString()
            //latLng = LatLng(point.latitude, point.longitude)
        }
    }
}
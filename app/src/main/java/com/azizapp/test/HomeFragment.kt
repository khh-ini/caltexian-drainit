package com.azizapp.test

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import com.google.android.gms.maps.CameraUpdateFactory
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.OnMapReadyCallback
import com.google.android.gms.maps.model.LatLng
import com.google.android.gms.maps.model.Marker
import com.google.android.gms.maps.model.MarkerOptions
import kotlinx.android.synthetic.main.fragment_home.*


class HomeFragment : Fragment() , OnMapReadyCallback{
    private lateinit var googleMap: GoogleMap
    private lateinit var marker : Marker

    override fun onActivityCreated(savedInstanceState: Bundle?) {
        super.onActivityCreated(savedInstanceState)
        mapView2.onCreate(savedInstanceState)
        mapView2.onResume()

        mapView2.getMapAsync(this)
    }
    override fun onCreateView(inflater: LayoutInflater, container: ViewGroup?,
                              savedInstanceState: Bundle?): View? {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_home, container, false)
    }

    override fun onMapReady(map: GoogleMap?) {
        map?.let {
            googleMap = it
        }
        val sydney = LatLng(-33.852, 151.211)
        //val perth = LatLng(-31.953512, 115.857048)
        googleMap.setInfoWindowAdapter(CustomInfoWindowAdapter(this.activity))
        marker = googleMap.addMarker(
                MarkerOptions()
                        .position(sydney)
                        .title("Marker in Sydney").snippet("Population: 4,137,400")
        )
//        googleMap.addMarker(
//                MarkerOptions()
//                        .position(perth)
//                        .title("Marker in Sydney").snippet("Population: 23,213,231")
//        )
        googleMap.moveCamera(CameraUpdateFactory.newLatLng(sydney))
  }

}
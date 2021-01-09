package com.azizapp.test

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import com.esri.arcgisruntime.mapping.ArcGISMap
import com.esri.arcgisruntime.mapping.Basemap
import com.google.android.gms.maps.CameraUpdateFactory
import kotlinx.android.synthetic.main.fragment_home.*
import kotlinx.android.synthetic.main.fragment_home.mapView
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.OnMapReadyCallback
import com.google.android.gms.maps.model.LatLng
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
        val pekanbaru = LatLng(0.510440, 101.438309)
        val perth = LatLng(0.5694928254013343, 101.42484671181263)
        val drainase3=LatLng(0.5716080649752078, 101.41617693789138)
        googleMap.setInfoWindowAdapter(CustomInfoWindowAdapter(this.activity))
        marker = googleMap.addMarker(
                MarkerOptions()
                        .position(pekanbaru)
                        .title("Drainase 1").snippet("Kondisi : Baik\nJenis : Alami")
        )
        googleMap.addMarker(
                MarkerOptions()
                        .position(perth)
                        .title("Drainase 2").snippet("Kondisi : Baik\n" +
                            "Jenis : Buatan")
        )
        googleMap.addMarker(
            MarkerOptions()
                .position(drainase3)
                .title("Drainase 3").snippet("Kondisi : Rusak\n" +
                        "Jenis : Alami")
        )
        googleMap.moveCamera(CameraUpdateFactory.newLatLng(pekanbaru))
  }

}
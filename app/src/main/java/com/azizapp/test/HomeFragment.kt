package com.azizapp.test

import android.content.Context
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
    private lateinit var googleMap : GoogleMap

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
//       val map = ArcGISMap(Basemap.Type.OPEN_STREET_MAP, 0.5695578669076772, 101.42584214573947, 14)
//        mapView.map = map

    }

    override fun onMapReady(map: GoogleMap?) {
        map?.let {
            googleMap = it
        }
        val sydney = LatLng(-33.852, 151.211)
        googleMap.addMarker(
                MarkerOptions()
                        .position(sydney)
                        .title("Marker in Sydney").snippet("Population: 4,137,400")
        )
        googleMap.moveCamera(CameraUpdateFactory.newLatLng(sydney))
    }

}
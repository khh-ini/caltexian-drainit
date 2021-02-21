package com.azizapp.test.fragment

import android.content.ContentValues.TAG
import android.os.Bundle
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.LinearLayout
import android.widget.Toast
import androidx.constraintlayout.widget.ConstraintLayout
import androidx.fragment.app.Fragment
import com.azizapp.test.CustomInfoWindowAdapter
import com.azizapp.test.R
import com.google.android.gms.maps.CameraUpdateFactory
import kotlinx.android.synthetic.main.fragment_home.*
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.OnMapReadyCallback
import com.google.android.gms.maps.model.LatLng
import com.google.android.gms.maps.model.Marker
import com.google.android.gms.maps.model.MarkerOptions
import com.google.android.material.bottomsheet.BottomSheetBehavior
import dagger.hilt.android.AndroidEntryPoint
import dagger.hilt.android.HiltAndroidApp
import kotlinx.android.synthetic.main.layout_persistent_bottom_sheet.view.*
import kotlinx.android.synthetic.main.splashscreen.*

@AndroidEntryPoint
class HomeFragment : Fragment() , OnMapReadyCallback{
    private lateinit var googleMap: GoogleMap
    private lateinit var marker : Marker
    private lateinit var bottomSheetBehavior: BottomSheetBehavior<ConstraintLayout>

    override fun onActivityCreated(savedInstanceState: Bundle?) {
        super.onActivityCreated(savedInstanceState)
        mapView2.onCreate(savedInstanceState)
        mapView2.onResume()

        mapView2.getMapAsync(this)
    }
    override fun onCreateView(inflater: LayoutInflater, container: ViewGroup?,
                              savedInstanceState: Bundle?): View? {

        val i = inflater.inflate(R.layout.fragment_home, container, false)

        // Inflate the layout for this fragment
        bottomSheetBehavior = BottomSheetBehavior.from(i.bottomsheet)

        bottomSheetBehavior.setBottomSheetCallback(object : BottomSheetBehavior.BottomSheetCallback() {
            override fun onStateChanged(bottomSheet: View, newState: Int) {
                when (newState) {
                    BottomSheetBehavior.STATE_HIDDEN -> {
                    }
                    BottomSheetBehavior.STATE_EXPANDED ->{}
                    BottomSheetBehavior.STATE_COLLAPSED ->{}
                    BottomSheetBehavior.STATE_DRAGGING -> {
                    }
                    BottomSheetBehavior.STATE_SETTLING -> {
                    }
                }
            }
            override fun onSlide(bottomSheet: View, slideOffset: Float) {
            }
        })
        bottomSheetBehavior.state = BottomSheetBehavior.STATE_HIDDEN
        return i
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
        googleMap.animateCamera( CameraUpdateFactory.zoomTo( 12.0f ) )
        googleMap.setOnMarkerClickListener { marker ->
            bottomSheetBehavior.state = BottomSheetBehavior.STATE_EXPANDED
            Log.d(TAG, "Clicked on  ${marker.tag}")
            true
        }
        googleMap.setOnMapClickListener {point ->
            Toast.makeText(context,"Titik : ${point.latitude}, ${point.longitude}",Toast.LENGTH_SHORT)
        }
    }

}
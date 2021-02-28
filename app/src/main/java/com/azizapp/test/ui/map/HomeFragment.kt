package com.azizapp.test.ui.map

import android.content.ContentValues.TAG
import android.os.Bundle
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.constraintlayout.widget.ConstraintLayout
import androidx.fragment.app.Fragment
import androidx.fragment.app.viewModels
import com.azizapp.test.CustomInfoWindowAdapter
import com.azizapp.test.R
import com.bumptech.glide.Glide
import com.google.android.gms.maps.CameraUpdateFactory
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.OnMapReadyCallback
import com.google.android.gms.maps.model.LatLng
import com.google.android.gms.maps.model.Marker
import com.google.android.gms.maps.model.MarkerOptions
import com.google.android.material.bottomsheet.BottomSheetBehavior
import dagger.hilt.android.AndroidEntryPoint
import kotlinx.android.synthetic.main.fragment_home.*
import kotlinx.android.synthetic.main.layout_persistent_bottom_sheet.*
import kotlinx.android.synthetic.main.layout_persistent_bottom_sheet.view.*

@AndroidEntryPoint
class HomeFragment : Fragment(), OnMapReadyCallback {
    private lateinit var googleMap: GoogleMap
    private lateinit var marker: Marker
    private lateinit var bottomSheetBehavior: BottomSheetBehavior<ConstraintLayout>
    val HomeViewModel: HomeFragmentViewModel by viewModels()
    var markerList: ArrayList<Marker>? = null

    override fun onActivityCreated(savedInstanceState: Bundle?) {
        super.onActivityCreated(savedInstanceState)
        mapView2.onCreate(savedInstanceState)
        mapView2.onResume()

        mapView2.getMapAsync(this)
        HomeViewModel.onLoad()
    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {

        val i = inflater.inflate(R.layout.fragment_home, container, false)

        // Inflate the layout for this fragment
        bottomSheetBehavior = BottomSheetBehavior.from(i.bottomsheet)

        bottomSheetBehavior.setBottomSheetCallback(object :
            BottomSheetBehavior.BottomSheetCallback() {
            override fun onStateChanged(bottomSheet: View, newState: Int) {
                when (newState) {
                    BottomSheetBehavior.STATE_HIDDEN -> {
                    }
                    BottomSheetBehavior.STATE_EXPANDED -> {
                    }
                    BottomSheetBehavior.STATE_COLLAPSED -> {
                    }
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

        googleMap.setInfoWindowAdapter(CustomInfoWindowAdapter(this.activity))

        googleMap.setOnMapLoadedCallback {
            HomeViewModel.listTitikBanjir.forEach { titik ->
                var mark = googleMap.addMarker(
                    MarkerOptions()
                        .position(geoToLatLong(titik.geometry))
                        .title(titik.namaJalan)
                        .snippet("${titik.keterangan}|${titik.foto}")
                )
                markerList?.add(mark)
                Log.d(TAG, "value on  ${geoToLatLong(titik.geometry)}")
            }
        }

        googleMap.moveCamera(CameraUpdateFactory.newLatLng(pekanbaru))
        googleMap.animateCamera(CameraUpdateFactory.zoomTo(13.0f))

        googleMap.setOnMarkerClickListener { marker ->
            bottomSheetBehavior.state = BottomSheetBehavior.STATE_EXPANDED
            tvTitle.text = marker.title
            var keteranganFoto : List<String> = marker.snippet.split("|")
            tvSubtitle.text = keteranganFoto[0]
            Glide.with(this).load("https://gis-drainase.pocari.id/storage/app/public/images/${keteranganFoto[1]}").into(gambar);
            Log.d(TAG, "Clicked on  ${geoToLatLong(HomeViewModel.listTitikBanjir[0].geometry)}")
            true
        }
        googleMap.setOnMapClickListener { point ->
            Toast.makeText(
                context,
                "Titik : ${point.latitude}, ${point.longitude}",
                Toast.LENGTH_SHORT
            )
        }
    }

    fun geoToLatLong(string : String) : LatLng {
        val substring = string.substring(34, string.length - 2)
        val latlong: List<String> = substring.split(",")
        val latLng = LatLng(latlong[1].toDouble(), latlong[0].toDouble())
        return latLng
    }
}

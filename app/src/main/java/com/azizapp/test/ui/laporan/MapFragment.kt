package com.azizapp.test.ui.laporan

import android.content.Intent
import android.os.Bundle
import android.widget.Toast
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.databinding.DataBindingUtil
import androidx.lifecycle.Observer
import com.azizapp.test.MainActivityNav
import com.azizapp.test.R
import com.azizapp.test.databinding.FragmentNamaJalanBinding
import com.google.android.gms.maps.*
import com.google.android.gms.maps.model.LatLng
import com.google.android.gms.maps.model.Marker
import kotlinx.android.synthetic.main.fragment_map.*
import kotlinx.android.synthetic.main.fragment_map.map
import kotlinx.android.synthetic.main.fragment_nama_jalan.*


class MapFragment : AppCompatActivity(), OnMapReadyCallback {

    private lateinit var mMap: GoogleMap
    private lateinit var marker: Marker
    lateinit var lat: String
    lateinit var lang: String

    lateinit var binding: FragmentNamaJalanBinding
    private val mapFragmentViewModel: MapFragmentViewModel by viewModels()


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.fragment_map)
        // Inflate the layout for this fragment
        map.onCreate(savedInstanceState)
        map.onResume()

        map.getMapAsync(this)
        binding = DataBindingUtil.setContentView(this, R.layout.fragment_nama_jalan)
        binding.apply {
            lifecycleOwner = this@MapFragment
            viewModelJalan = mapFragmentViewModel
        }

        mapFragmentViewModel.action.observe(this, Observer { action ->
            when (action) {
                MapFragmentViewModel.ACTION_SUCCESS -> actionSuccess()
                MapFragmentViewModel.ACTION_FAILED -> actionFailed()
            }
        })
    }

    private fun actionFailed() {
        TODO("Not yet implemented")
    }

    private fun actionSuccess() {
        val intent = Intent(this, MainActivityNav::class.java)
        intent.putExtra("lat", mapFragmentViewModel.latitude.toString())
        intent.putExtra("long", mapFragmentViewModel.longitude.toString())
        startActivity(intent)
    }

    override fun onMapReady(googleMap: GoogleMap) {
        mMap = googleMap
        val pekanbaru = LatLng(0.510440, 101.438309)

        googleMap.moveCamera(CameraUpdateFactory.newLatLng(pekanbaru))
        googleMap.animateCamera(CameraUpdateFactory.zoomTo(12.0f))
        googleMap.setOnMapClickListener { point ->
            mapFragmentViewModel.changeStreetName(this, point.latitude, point.latitude)
            tv_namaJalan.setText(mapFragmentViewModel.namaJalan.toString())
            Toast.makeText(
                this,
                mapFragmentViewModel.namaJalan.toString(),
                Toast.LENGTH_SHORT
            ).show()
        }
    }
}
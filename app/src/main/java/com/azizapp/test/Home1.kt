package com.azizapp.test

import android.os.Bundle
import android.view.View
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment
import kotlinx.android.synthetic.main.splashscreen.*
import com.esri.arcgisruntime.mapping.ArcGISMap
import com.esri.arcgisruntime.mapping.Basemap
import com.ismaeldivita.chipnavigation.ChipNavigationBar
import com.ismaeldivita.chipnavigation.ChipNavigationBar.OnItemSelectedListener
import kotlinx.android.synthetic.main.home1.*
import kotlinx.android.synthetic.main.splash.*

class Home1:AppCompatActivity(){
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.home1)

        val map = ArcGISMap(Basemap.Type.OPEN_STREET_MAP, 0.5695578669076772, 101.42584214573947, 14)
        mapView.map = map
    }
}
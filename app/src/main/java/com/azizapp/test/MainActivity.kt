package com.azizapp.test

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import androidx.viewpager2.widget.ViewPager2
import me.relex.circleindicator.CircleIndicator3

class MainActivity : AppCompatActivity() {

    private var descList = mutableListOf<String>()
    private var imagesList = mutableListOf<Int>()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.splash)

        postToList()

        view_pager2.adapter = ViewPagerAdapter(descList, imagesList)
        view_pager2.orientation = ViewPager2.ORIENTATION_HORIZONTAL

        val indicator = findViewById<CircleIndicator3>(R.id.indicator)
        indicator.setViewPager(view_pager2)
    }

    private fun addToList(description: String, image: Int) {
        descList.add(description)
        imagesList.add(image)
    }

    private fun postToList() {
        for (i in 1..2) {
            addToList("$i", R.drawable.hprusak)
        }
    }
}
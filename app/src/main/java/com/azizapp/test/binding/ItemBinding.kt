package com.azizapp.test.binding

import android.widget.ImageView
import androidx.databinding.BindingAdapter
import com.azizapp.test.utill.Constant
import com.bumptech.glide.Glide

@BindingAdapter("app:loadImgFromUrl")
fun ImageView.loadImgFromUrl(url: String) {
    val fullUrl = "https://gis-drainase.pocari.id/storage/app/public/images/" + url
    Glide.with(this.context).load(fullUrl).into(this)
}
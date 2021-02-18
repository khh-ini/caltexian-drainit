package com.azizapp.test.ui.laporan

import android.content.Context
import android.location.Address
import android.location.Geocoder
import androidx.hilt.lifecycle.ViewModelInject
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.azizapp.test.repository.MainRepository
import com.azizapp.test.utill.Session
import kotlinx.coroutines.launch
import java.util.*

class MapFragmentViewModel : ViewModel() {

    companion object {
        const val ACTION_SUCCESS = "ACTION_SUCCESS"
        const val ACTION_FAILED = "ACTION_FAILED"
    }

    val namaJalan = MutableLiveData<String>()
    val action = MutableLiveData<String>()
    val latitude = MutableLiveData<Double>()
    val longitude = MutableLiveData<Double>()

    fun changeStreetName(context: Context, lat: Double, long: Double) {
        viewModelScope.launch {
            val geocoder = Geocoder(context, Locale.getDefault())
            val addresses: MutableList<Address>? = geocoder.getFromLocation(lat, long, 1)
            val address: String? = addresses?.get(0)?.getAddressLine(0)
            val city: String? = addresses?.get(0)?.getLocality()
            latitude.postValue(lat)
            longitude.postValue(long)
            namaJalan.postValue("$address $city")

        }
    }

    fun btnConfirmClick() {
        viewModelScope.launch {
            if (!namaJalan.value.isNullOrEmpty()) {
                action.postValue(ACTION_SUCCESS)
                Session.namaJalan = namaJalan.value
            } else {
                action.postValue(ACTION_FAILED)
            }
        }
    }
}
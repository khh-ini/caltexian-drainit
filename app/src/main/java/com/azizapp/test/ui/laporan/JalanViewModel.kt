package com.azizapp.test.ui.laporan

import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel

class JalanViewModel:ViewModel() {

    private val namaJalan = MutableLiveData<String>("")
    private val latitude = MutableLiveData<Double>(0.0)
    private val longitude = MutableLiveData<Double>(0.0)



}
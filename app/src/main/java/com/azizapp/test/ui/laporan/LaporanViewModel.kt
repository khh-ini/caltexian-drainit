package com.azizapp.test.ui.laporan

import androidx.hilt.lifecycle.ViewModelInject
import androidx.lifecycle.MediatorLiveData
import androidx.lifecycle.ViewModel

class LaporanViewModel @ViewModelInject constructor() :ViewModel() {
    val lang =  MediatorLiveData<String>()
    val lat = MediatorLiveData<String>()
}
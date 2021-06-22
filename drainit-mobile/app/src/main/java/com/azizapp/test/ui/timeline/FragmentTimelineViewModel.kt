package com.azizapp.test.ui.timeline

import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.azizapp.test.model.Pengaduan
import com.azizapp.test.model.PengaduanResponse
import com.azizapp.test.repository.MainRepository
import com.azizapp.test.ui.riwayat.RiwayatViewModel
import com.azizapp.test.utill.Resource
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.collect
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class FragmentTimelineViewModel @Inject constructor(
    private val repository: MainRepository
) : ViewModel() {

    val laporan : ArrayList<Pengaduan> = arrayListOf()
    val semuaLaporan = MutableLiveData<ArrayList<Pengaduan>>()
    val loadingEnable = MutableLiveData<Boolean>()

    fun getLaporan() {
        viewModelScope.launch {
            when (val response = repository.getSemuaLaporan()) {
                is Resource.Success -> {
                    response.data?.forEach {
                        laporan.add(it)
                    }
                    semuaLaporan.postValue(laporan)
                    loadingEnable.postValue(false)
                }
                is Resource.Error -> {
                    loadingEnable.postValue(false)
                }
            }
        }
    }
}
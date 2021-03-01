package com.azizapp.test.ui.map

import androidx.hilt.lifecycle.ViewModelInject
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.azizapp.test.model.TitikBanjir
import com.azizapp.test.repository.MainRepository
import com.azizapp.test.ui.riwayat.RiwayatViewModel
import com.azizapp.test.utill.Resource
import kotlinx.coroutines.launch

class HomeFragmentViewModel @ViewModelInject constructor(
    public val repository: MainRepository
) : ViewModel() {
    val listTitikBanjir: ArrayList<TitikBanjir> = arrayListOf()
    val action = MutableLiveData<String>()
    val actionItemPosition = MutableLiveData<Int>()

    fun onLoad(){
        viewModelScope.launch {
            when (val response = repository.getTitikBanjir() ) {
                is Resource.Success -> {
                    response.data?.forEach {
                        val titikBanjir = TitikBanjir(
                            foto = it.foto,
                            geometry = it.geometry,
                            namaJalan = it.namaJalan,
                            id = it.id,
                            kondisiKerusakan = it.kondisiKerusakan,
                            keterangan = it.keterangan
                        )

                        listTitikBanjir.add(titikBanjir)
                    }
                    action.postValue(RiwayatViewModel.ACTION_RIWAYAT_FETCHED)
                }
                is Resource.Error -> {
                }
            }
        }
    }
}
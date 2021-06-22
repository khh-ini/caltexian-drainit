package com.azizapp.test.ui.timeline

import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.azizapp.test.model.Pengaduan
import com.azizapp.test.model.pengaduanvote.PengaduanWithVoteItem
import com.azizapp.test.model.vote.Vote
import com.azizapp.test.model.vote.VoteUpdate
import com.azizapp.test.repository.MainRepository
import com.azizapp.test.utill.Resource
import com.azizapp.test.utill.Session
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class FragmentTimelineViewModel @Inject constructor(
    private val repository: MainRepository
) : ViewModel() {

    val laporan: ArrayList<Pengaduan> = arrayListOf()
    val semuaLaporan = MutableLiveData<ArrayList<Pengaduan>>()
    val laporanVote: ArrayList<PengaduanWithVoteItem> = arrayListOf()
    val semuaLaporanVote = MutableLiveData<ArrayList<PengaduanWithVoteItem>>()
    val loadingEnable = MutableLiveData<Boolean>()
    val voteAction = MutableLiveData<String>()

    val name = "zee"
    companion object {
        const val VOTE_EXIST = "VOTE_EXIST"
        const val VOTE_OK = "VOTE_OK"
    }

    fun getLaporan() {
        loadingEnable.value = true
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
    fun getLaporanVote() {
        loadingEnable.value = true
        val bearer = "Bearer " + Session.bearer
        viewModelScope.launch {
            when (val response = repository.getSemuaLaporanVote(bearer)) {
                is Resource.Success -> {
                    response.data?.forEach {
                        laporanVote.add(it)
                    }
                    semuaLaporanVote.postValue(laporanVote)
                    loadingEnable.postValue(false)
                }
                is Resource.Error -> {
                    loadingEnable.postValue(false)
                }
            }
        }
    }

    fun vote(id: String, vote: Boolean) {
        val vote = Vote(id, vote)
        val bearer = "Bearer " + Session.bearer
        viewModelScope.launch {
            when (val response = repository.vote(bearer, vote)) {
                is Resource.Success -> {
                    if (response.message != "vote sudah ada") {
                        voteAction.postValue(VOTE_EXIST)
                        loadingEnable.postValue(false)
                    }else{
                        voteAction.postValue(VOTE_OK)
                        loadingEnable.postValue(false)
                    }
                }
                is Resource.Error -> {
                    loadingEnable.postValue(false)
                }
            }
        }
    }

    fun voteUpdate(idPengaduan : String , vote: Boolean) {
        val vote = VoteUpdate("put",vote)
        val bearer = "Bearer " + Session.bearer
        viewModelScope.launch {
            when (val response = repository.voteUpdate(idPengaduan,bearer, vote)) {
                is Resource.Success -> {
                    if (response.message != "vote sudah ada") {
                        voteAction.postValue(VOTE_EXIST)
                        loadingEnable.postValue(false)
                    }else{
                        voteAction.postValue(VOTE_OK)
                        loadingEnable.postValue(false)
                    }
                }
                is Resource.Error -> {
                    loadingEnable.postValue(false)
                }
            }
        }
    }
}
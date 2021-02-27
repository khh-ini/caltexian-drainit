package com.azizapp.test.fragment

import android.content.Context
import android.content.SharedPreferences
import android.os.Bundle
import android.preference.PreferenceManager
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.databinding.DataBindingUtil
import androidx.fragment.app.Fragment
import androidx.fragment.app.viewModels
import androidx.lifecycle.Observer
import androidx.recyclerview.widget.LinearLayoutManager
import com.azizapp.test.R
import com.azizapp.test.RiwayatRecyclerAdapter
import com.azizapp.test.databinding.FragmentRiwayatBinding
import com.azizapp.test.model.Pengaduan
import com.azizapp.test.ui.riwayat.DetilRiwayat
import com.azizapp.test.ui.riwayat.RiwayatRecyclerViewListener
import com.azizapp.test.ui.riwayat.RiwayatViewModel
import dagger.hilt.android.AndroidEntryPoint


@AndroidEntryPoint
class RiwayatFragment : Fragment(), RiwayatRecyclerViewListener {

    private val riwayatViewModel: RiwayatViewModel by viewModels()
    private lateinit var riwayatAdapter: RiwayatRecyclerAdapter
    private lateinit var dataBinding: FragmentRiwayatBinding

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        riwayatAdapter = RiwayatRecyclerAdapter(riwayatViewModel, this)
        dataBinding = DataBindingUtil.inflate(inflater, R.layout.fragment_riwayat, container, false)
        return dataBinding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        setupRecyclerView()
        dataBinding.apply {
            lifecycleOwner = this@RiwayatFragment
            viewModelRiwayat = riwayatViewModel
        }

        riwayatViewModel.action.observe(viewLifecycleOwner, Observer { action ->
            when (action) {
                RiwayatViewModel.ACTION_RIWAYAT_FETCHED -> listItemUpdate()
            }
        })

        riwayatViewModel.onLoad()
    }

    private fun setupRecyclerView() {
        dataBinding.recyclerView.apply {
            layoutManager =
                LinearLayoutManager(requireContext(), LinearLayoutManager.VERTICAL, false)
            adapter = this@RiwayatFragment.riwayatAdapter
        }
    }

    private fun listItemUpdate() {
        riwayatAdapter.items = riwayatViewModel.listPengaduan
        riwayatAdapter.notifyDataSetChanged()
    }

    override fun onRecyclerViewItemClick(view: View, pengaduan: Pengaduan) {
        when (view.id) {
            R.id.rl_klik -> {
//                dataBinding = DataBindingUtil.setContentView(
//                    requireActivity(),
//                    R.layout.activity_detil_riwayat
//                )
//                dataBinding.apply {
//                    lifecycleOwner = activity@DetilRiwayat
//                    viewModel = riwayatViewModel
//                }
//                riwayatViewModel.onLoad()
            }
        }
    }
}
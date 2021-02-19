package com.azizapp.test.fragment

import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.databinding.DataBindingUtil
import androidx.fragment.app.viewModels
import androidx.lifecycle.Observer
import androidx.recyclerview.widget.LinearLayoutManager
import com.azizapp.test.R
import com.azizapp.test.RiwayatRecyclerAdapter
import com.azizapp.test.databinding.FragmentRiwayatBinding
import com.azizapp.test.ui.riwayat.RiwayatViewModel
import kotlinx.android.synthetic.main.fragment_riwayat.*
import kotlinx.android.synthetic.main.splash.*

class RiwayatFragment : Fragment() {

    private val riwayatViewModel: RiwayatViewModel by viewModels()
    private lateinit var riwayatAdapter: RiwayatRecyclerAdapter
    private lateinit var dataBinding: FragmentRiwayatBinding

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        //return inflater.inflate(R.layout.fragment_riwayat, container, false)
        riwayatAdapter = RiwayatRecyclerAdapter(riwayatViewModel)
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
    }

    private fun setupRecyclerView() {
        dataBinding.recyclerView.apply {
            layoutManager =
                LinearLayoutManager(requireContext(), LinearLayoutManager.VERTICAL, false)
            adapter = riwayatAdapter
        }
    }

    private fun listItemUpdate() {
        riwayatAdapter.items = riwayatViewModel.listPengaduan
    }
}
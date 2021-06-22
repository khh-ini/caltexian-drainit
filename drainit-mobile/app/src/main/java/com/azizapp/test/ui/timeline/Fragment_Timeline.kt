package com.azizapp.test.ui.timeline

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import androidx.fragment.app.viewModels
import androidx.recyclerview.widget.LinearLayoutManager
import com.azizapp.test.databinding.FragmentTimelineFragmentBinding
import com.azizapp.test.model.pengaduanvote.PengaduanWithVoteItem
import com.google.android.material.chip.Chip
import dagger.hilt.android.AndroidEntryPoint
import java.util.*

@AndroidEntryPoint
class Fragment_Timeline : Fragment() {

    private val viewModel: FragmentTimelineViewModel by viewModels()
    private lateinit var binding: FragmentTimelineFragmentBinding
    private lateinit var adapter: TimelineAdapter

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        binding = FragmentTimelineFragmentBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        adapter = TimelineAdapter(viewModel)
        viewModel.getLaporanVote()
        setupRecyclerView()
        viewModel.semuaLaporanVote.observe(viewLifecycleOwner) {
            binding.pullToRefresh.setOnRefreshListener {
                setupRecyclerView()
                binding.pullToRefresh.isRefreshing = false
            }
        }
    }

    private fun setupRecyclerView() {
        viewModel.getLaporan()
        viewModel.semuaLaporanVote.observe(viewLifecycleOwner) { data ->
            binding.chipGrouoTimeline.setOnCheckedChangeListener { group, checkedId ->
                val chip: Chip? = group.findViewById(checkedId)
                val filterDown = data.sortedByDescending { it.downvote }
                val filterUp = data.sortedByDescending { it.upvote }
                val listUp: ArrayList<PengaduanWithVoteItem> = arrayListOf()
                val listDown: ArrayList<PengaduanWithVoteItem> = arrayListOf()
                filterUp.forEach {
                    listUp.add(it)
                }
                filterDown.forEach {
                    listDown.add(it)
                }
                chip?.let { chipView ->
                    if (chipView.text == "Semua Laporan") adapter.setData(data)
                    if (chipView.text == "Terhangat") adapter.setData(listUp)
                    if (chipView.text == "Terburuk") adapter.setData(listDown)
                }
            }
            adapter.setData(data)
            binding.rvLaporan.apply {
                layoutManager =
                    LinearLayoutManager(requireContext(), LinearLayoutManager.VERTICAL, false)
                adapter = this@Fragment_Timeline.adapter
            }
        }
        viewModel.loadingEnable.observe(viewLifecycleOwner) {
            binding.pbLoadTimeline.visibility = if (it) View.VISIBLE else View.GONE
        }
    }
}
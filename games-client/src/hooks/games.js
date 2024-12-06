import useSWR from 'swr'
import axios from '@/lib/axios'

const fetcher = url => axios.get(url).then(res => res.data)
export const useGames = () => {
    const { data, error, isLoading, mutate } = useSWR('/api/games', fetcher)

    const handleJoinGame = (gameId) => {
        axios.post(`/api/games/${gameId}/join`)
    }

    const updateGames = (games) => {
        mutate(games, { revalidate: false })
    }

    const handleLeaveGame = (gameId) => {
        axios.post(`/api/games/${gameId}/leave`)
    }

    return {
        games: data,
        error,
        isLoading,
        handleJoinGame,
        handleLeaveGame,
        updateGames
    }
}
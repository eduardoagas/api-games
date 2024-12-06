'use client'

import { useGames } from "@/hooks/games"
import { useEffect } from "react";
import useEcho from "@/hooks/echo";

const GamesList = () => {
    const { games, error, isLoading, handleJoinGame, handleLeaveGame, updateGames } = useGames()

    const echo = useEcho();

    useEffect(() => {
        if (echo) {
            const channel = echo.channel('games')

            channel.listen('GamesUpdated', (data) => {
                updateGames(data.games)
            })

            return () => {
                channel.stopListening('GamesUpdated')
            }
        }

    }, [echo, updateGames])

    return (
        <div className="p-6">

            <div className="font-bold text-2xl">Games</div>
            {isLoading ? (
                <p>Loading games...</p>
            ) : error ? (
                <p>Error loading games: {error.message}</p>
            ) : games && games.length > 0 ? (
                <ul>
                    {games.map(game => (
                        <li className="py-6 flex justify-between " key={game.id}>
                            {game.name}
                            <div className="flex gap-2">
                                <span className="mr-4 text-gray-600">
                                    Players {game.player_count} /  {game.max_players}
                                </span>
                                <button className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onClick={() => handleJoinGame(game.id)}>Join Game</button>
                                <button className="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onClick={() => handleLeaveGame(game.id)}>Leave Game</button>
                            </div>
                        </li>
                    ))}
                </ul>
            ) : (
                <p>No games available</p>
            )}
        </div>

    )
}

export default GamesList
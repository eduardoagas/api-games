import Header from '@/app/(app)/Header'
import GamesList from '@/components/GamesList'

export const metadata = {
    title: 'Laravel - Dashboard',
}

const Dashboard = () => {
    return (
        <>
            <Header title="Dashboard" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <GamesList/>
                    </div>
                </div>
            </div>
        </>
    )
}

export default Dashboard
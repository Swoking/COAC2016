#include "listeleve.h"
#include <QStandardItemModel>
#include <QSqlQuery>
#include "database.h"

ListEleve::ListEleve(COAC *parentFenetre, Database *database) :
    MyList(parentFenetre, database)
{
    this->setWindowTitle("liste des élèves");

    connect(myTreeList, SIGNAL(doubleClicked(QModelIndex)), (QObject*)parentFenetre, SLOT(onDoubleClickListEleve(QModelIndex)));
    showList();
}

ListEleve::ListEleve(AddCarte *parentFenetre, Database *database):
    MyList(parentFenetre, database)
{
    connect(myTreeList, SIGNAL(doubleClicked(QModelIndex)), (QObject*)parentFenetre, SLOT(onDoubleClickListEleve(QModelIndex)));
    showList();
}

void ListEleve::showList(){

    if(db->getDB().isOpen()){

        QSqlQuery queryPromos;
        queryPromos.prepare("SELECT * FROM Promo;");
        queryPromos.exec();

        QStandardItemModel *model = new QStandardItemModel();
        while (queryPromos.next()) {
            qDebug() << "eleveList::showList() > ajout d'une classe.";
            QStandardItem *itemClasse = new QStandardItem();
            itemClasse->setText( queryPromos.value(3).toString() );
            itemClasse->setFlags(itemClasse->flags() & ~Qt::ItemIsEditable);
            model->appendRow(itemClasse);

            QSqlQuery queryEtudiants;
            queryEtudiants.prepare("SELECT * FROM Etudiant WHERE id_Promo = ?");
            queryEtudiants.addBindValue(queryPromos.value(0));
            queryEtudiants.exec();
             while (queryEtudiants.next()) {
                 qDebug() << "eleveList::showList(d) > ajout d'un étudiant.";
                 QStandardItem *itemEtudiant = new QStandardItem();
                 itemEtudiant->setText(queryEtudiants.value(1).toString() + " " + queryEtudiants.value(2).toString());
                 itemEtudiant->setData(queryEtudiants.value(0).toInt());
                 itemEtudiant->setFlags(itemClasse->flags() & ~Qt::ItemIsEditable);
                 itemClasse->appendRow( itemEtudiant );
             }
        }
        myTreeList->setModel(model);
    }

}
